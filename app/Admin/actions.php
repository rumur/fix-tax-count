<?php

namespace Rumur\App\Admin;

use Rumur\Plugin;

/**
 * Adds the button to the Category Screen and allows to reindex the Terms post count.
 *
 * @author rumur
 */
add_action('current_screen', function($current_screen) {
    if (in_array($current_screen->base, ['edit-tags']) ) {
        add_action('admin_notices', function () use ($current_screen) {
            wp_enqueue_script('wp-util');
            try {
                $notice_class = array(
                    'notice',
                    'notice-info',    // blue
                    //'notice-error'    // red
                    //'notice-warning'  // yellow/orange
                    //'notice-success'  // green
                );
                $html = '<div class="%1$s"><p><strong>%2$s</strong></p></div>';
                $btn = sprintf('<span class="spinner"></span><button class="button button-primary" 
                        data-post_type="%2$s"
                        data-taxonomy="%3$s"
                        onclick="reIndexPostCount(this)"
                    >%1$s</button>',
                    __('Reindex?', 'rumur'),
                    $current_screen->post_type,
                    $current_screen->taxonomy
                );
                $nonce = wp_create_nonce('reindex-post-count');
                $patient = __('Be patient, we are working on it.', Plugin::TEXT_DOMAIN);
                $problem = __('We are sorry, something bad happened.', Plugin::TEXT_DOMAIN);

                $script = "
                    <script type=\"text/javascript\">  
                   
                    var DontRunAnyMore = false;
                    var ReIndexInProgress = false;
                    
                    function reIndexPostCount(btn) {
                        try { 
                            var spinner = btn.previousSibling;
                            
                            if (ReIndexInProgress) {
                                alert('{$patient}');
                            } else if (DontRunAnyMore) {
                                alert('{$problem}');
                            } else {
                                ReIndexInProgress = true;
                                
                                spinner.classList.toggle('is-active', ReIndexInProgress);
                                
                                 wp.ajax.post('fix_taxonomy_count', {
                                    _ajax_nonce: '{$nonce}',
                                    post_type: btn.dataset.post_type,
                                    taxonomy:  btn.dataset.taxonomy,
                                }).done( function( response ) {
                                    ReIndexInProgress = false;
                                    spinner.classList.toggle('is-active', ReIndexInProgress);
                                    if (confirm(response)) {
                                        window.location.reload();
                                    }
                                }).fail(function(response) {
                                    ReIndexInProgress = false;
                                    spinner.classList.toggle('is-active', ReIndexInProgress);
                                    alert(response);
                                });
                            }
                        } catch (e) {
                            DontRunAnyMore = true;
                            ReIndexInProgress = false;
                            spinner.classList.toggle('is-active', ReIndexInProgress);
                          console.error('Category Reindexer:: ', e);
                        }
                    }
                    </script>
                ";
                $message = [
                    $script,
                    sprintf(__('Do you want to reindex %s posts count?', Plugin::TEXT_DOMAIN), get_taxonomy($current_screen->taxonomy)->label),
                    $btn,
                ];
                printf($html, join(' ', $notice_class), join(' ', $message));
            } catch (\Exception $e) {
                \Rumur\Helpers\is_debug()
                    ? \Rumur\Facades\NoticeAdmin::addError( $e )
                    : error_log('< Taxonomy count reindexer > ' . $e);
            } catch (\Throwable $e) {
                \Rumur\Helpers\is_debug()
                    ? \Rumur\Facades\NoticeAdmin::addError( $e )
                    : error_log('< Taxonomy count reindexer > ' . $e);
            }
        });
    }
});

/**
 * Re indexer AJAX handler.
 *
 * @author rumur
 */
add_action('wp_ajax_fix_taxonomy_count', function() {
    $data = (object) $_POST;
    try {
        if (\check_ajax_referer('reindex-post-count')) {
            \Rumur\App\FixTaxCount::make($data->post_type, $data->taxonomy)->process()
                ? \wp_send_json_success(__('Done! Reload the Page?', 'rumur'))
                : \wp_send_json_error(__('Something went wrong.', 'rumur'));
        }
    } catch (\Exception $e) {
        \Rumur\Helpers\is_debug()
            ? \wp_send_json_error($e->getMessage())
            : \wp_send_json_error(__('Something went wrong.', 'rumur'));
    } catch (\Throwable $e) {
        \Rumur\Helpers\is_debug()
            ? \wp_send_json_error($e->getMessage())
            : \wp_send_json_error(__('Something went wrong.', 'rumur'));
    }
});