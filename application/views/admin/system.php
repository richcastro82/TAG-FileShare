<?php
if(!isset($settings['debug_mode']) && !isset($_GET['redirect'])) {
    echo '<script>setTimeout(function() { window.location.href = window.location.href + "?update=done&redirect=done"; }, 1000);</script>';
}
?>
    <div class="container-xl">
        <div class="page-body margins">
            <?php if(!$htaccess_check_2_3_2) : ?>
                <div class="alert alert-danger" style="margin: 10px 0 20px 0;">
                    <h4>Important!</h4>
                    It seems like you're missing the <code>application/.htaccess</code> file, please copy it over from your Droppy ZIP or download it from <a href="https://raw.githubusercontent.com/bcit-ci/CodeIgniter/develop/application/.htaccess" target="_blank">here</a> and place it into the application/ directory.
                    <br>
                </div>
            <?php endif; ?>

            <div class="row row-cards">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                System info
                            </h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-5">Site URL</dt>
                                <dd class="col-7"><a href="<?php echo $settings['site_url'] ?>"><?php echo $settings['site_url'] ?></a></dd>
                                <dt class="col-5">Install path</dt>
                                <dd class="col-7"><?php echo FCPATH ?></dd>
                                <dt class="col-5">Droppy version</dt>
                                <dd class="col-7"><?php echo $settings['version'] ?></dd>
                                <dt class="col-5">Droppy mode</dt>
                                <dd class="col-7"><?php echo ENVIRONMENT ?></dd>
                                <dt class="col-5">Droppy debug mode</dt>
                                <dd class="col-7"><?php echo $settings['debug_mode'] ?> <a href="system?action=debug" onclick="return confirm('Debugging mode should only be used for testing, it can generate a large log file on your server when you leave it enabled in production. Make sure to disable it when you\'re done with testing.')"><span class="badge bg-blue"><?php echo ($settings['debug_mode'] == 'true' ? 'Disable' : 'Enable') ?></span></a></dd>
                                <dt class="col-5">Active theme</dt>
                                <dd class="col-7"><?php echo $settings['theme'] ?></dd>
                                <dt class="col-5">Active plugins</dt>
                                <dd class="col-7">
                                    <?php
                                    foreach ($plugins as $plugin) {
                                        echo $plugin['name'] . '<br>';
                                    }
                                    ?>
                                </dd>
                                <dt class="col-5">PHP version</dt>
                                <dd class="col-7"><?php echo phpversion() ?></dd>
                                <dt class="col-5">PHP SAPI</dt>
                                <dd class="col-7"><?php echo php_sapi_name() ?></dd>
                                <dt class="col-5">PHP settings</dt>
                                <dd class="col-7">
                                    <ul style="list-style: none; padding: 0; margin: 0;">
                                        <li><b>post_max_size:</b> <?php echo ini_get('post_max_size') ?></li>
                                        <li><b>upload_max_filesize:</b> <?php echo ini_get('upload_max_filesize') ?></li>
                                        <li><b>max_execution_time:</b> <?php echo ini_get('max_execution_time') ?></li>
                                        <li><b>memory_limit:</b> <?php echo ini_get('memory_limit') ?></li>
                                        <li><b>display_errors:</b> <?php echo ini_get('display_errors') ?></li>
                                    </ul>
                                </dd>
                                <dt class="col-5">PHP loaded modules</dt>
                                <dd class="col-7"><?php foreach (get_loaded_extensions() as $module) { echo '<span class="badge bg-blue-lt">' . $module . '</span> '; } ?></dd>
                                <dt class="col-5">CURL version</dt>
                                <dd class="col-7"><?php echo curl_version()['version'] ?></dd>
                                <dt class="col-5">Available storage</dt>
                                <dd class="col-7"><?php echo $settings['upload_dir'] . ' <span class="badge bg-purple-lt">' . byte_format(disk_free_space($settings['upload_dir'])) . '</span>' ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="col">
                                <h4 class="card-title">Update system</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-panel" style="overflow:hidden;" id="updateDiv">
                                <?php
                                if(function_exists('curl_version') != '') :
                                    if(isset($latest_version->version) && ($settings['version'] == $latest_version->version || $settings['version'] > $latest_version->version)):
                                        ?>
                                        <div class="alert alert-success">
                                            <p>You are using the latest version available (<?php echo $latest_version->version ?>).<br>
                                                Signup <a href="https://newsletter.proxibolt.com" target="_blank">here</a> and get notified when there is a new update available.
                                        </div>
                                    <?php
                                    else:
                                        ?>
                                        <h4 class="mb"><i class="fa fa-server"></i> Auto-Update</h4>
                                        <form method="POST">
                                            <input type="hidden" name="action" value="update">
                                            <?php
                                            if(isset($error) && !empty($error)) {
                                                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                                            }
                                            if(isset($pb_message) && $pb_message->show == 1) {
                                                echo $pb_message->msg;
                                            }
                                            ?>
                                            <p>Your version of Droppy is outdated and needs to be updated, please enter your purchase code below and Droppy will do the rest for you.</p>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="purchase_code" placeholder="Your purchase code" value="<?php echo $settings['purchase_code']; ?>" required>
                                                <p><i>Don't know where to find your purchase code ? Please give a look to this article: <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Can-I-Find-my-Purchase-Code-">here</a></i></p>
                                            </div>

                                            <button type="submit" class="btn btn-primary" onclick="this.innerHTML = 'Updating..'"><i class="fa fa-wrench"></i>&nbsp;Update</button>
                                        </form>
                                    <?php
                                    endif;
                                endif;
                                ?>
                            </div>
                            <br>
                            <?php if(isset($latest_version->version) && ($settings['version'] != $latest_version->version || $settings['version'] < $latest_version->version)): ?>
                                <div class="form-panel" style="overflow:hidden;" id="manualUpdate">
                                    <h4 class="mb"><i class="fa fa-server"></i> Manual update</h4>
                                    <form method="POST">
                                        <input type="hidden" name="action" value="manual_update">
                                        <p>You can manually download the latest version to your desktop with the form below, this can be used if your system is unable to update automatically.</p>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="purchase_code" placeholder="Your purchase code" value="<?php echo $settings['purchase_code']; ?>" required>
                                            <p><i>Don't know where to find your purchase code ? Please give a look to this article: <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Can-I-Find-my-Purchase-Code-">here</a></i></p>
                                        </div>

                                        <button type="submit" class="btn btn-primary"><i class="fa fa-download"></i>&nbsp;Download</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <div class="form-panel" style="overflow:hidden; display: none;" id="updatingDiv">
                                <div style="padding-top: 25px;">
                                    <p style="text-align:center;"><i class="fa fa-spinner fa-pulse fa-3x"></i><br><br>
                                        Updating your system, please be patient.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="card">
                        <div class="card-header">
                            <div class="col">
                                <h4 class="card-title">Last 5 updates</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-panel" style="overflow:hidden;">
                                <table class="table table-bordered table-striped table-condensed sortable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Version</th>
                                        <th>Date installed</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if($updates !== false && count($updates) > 0) {
                                        foreach ($updates as $row) {
                                            echo '<tr>';
                                            echo '<td>' . $row['id'] . '</td>';
                                            echo '<td>' . $row['version'] . '</td>';
                                            echo '<td>' . $row['date'] . '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col">
                                <h4 class="card-title">Recent Droppy logs <?php echo ($settings['debug_mode'] == 'false' ? '<span class="badge bg-red-lt">Disabled</span>' : '') ?></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Log items are only added when debugging is enabled</p>
                            <textarea readonly="readonly" style="width: 100%; min-height: 300px;"><?php
                                if(file_exists(FCPATH . 'droppy.log')) {
                                    $file = file(FCPATH . 'droppy.log');
                                    if(count($file) > 0) {
                                        $lines = count($file);
                                        for ($i = max(0, $lines - 200); $i < count($file); $i++) {
                                            $line = $lines - ($i + 1);
                                            echo $file[$line];
                                        }
                                    } else {
                                        echo FCPATH . 'droppy.log file is empty';
                                    }
                                } else {
                                    echo FCPATH . 'droppy.log file does not exist';
                                }
                                ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php if(isset($updated) && $updated): ?>
    <div class="modal modal-blur fade show" id="changelog-modal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Changelog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2>Droppy has been updated to V<?php echo $settings['version'] ?>!</h2>
                    <hr>
                    <h2>Are you enjoying these free updates?</h2>
                    <p>If you do then please leave a review on <a href="https://proxibolt.zendesk.com/hc/en-us/articles/5427494964754" target="_blank">CodeCanyon</a>, it would help out a lot &#128522;</p>
                    <img src="https://src.proxibolt.com/droppy/5stars.png" width="200"><br><br>
                    <a href="https://proxibolt.zendesk.com/hc/en-us/articles/5427494964754" target="_blank" class="btn btn-info">Leave review</a>
                    <hr>
                    <pre style="max-height: 500px; overflow-y: auto;">
V2.4.2
- Fixed an issue that caused the downloading of files not to work in some mobile browsers
- Fixed an issue that caused some incorrect tabs to be shown in the header when using the Premium add-on

V2.4.1
- Fixed issue where upload buttons wasn't showing in the latest update of Safari
- Added message to download page when using Facebook in-app browser

V2.4.0
- Fixed issue with base URL in custom navbar pages
- Fixed issues with email verification form
- Email verification code form can now be submitted using the enter button
- Added cron job to clean up pending email verifications
- Added "view video" button to video backgrounds on the backgrounds page in the admin panel
- Improved session security

V2.3.9
- Added email verification option to verify the sender's email address using a verification code (can be found on the upload settings page)
- The change language tab will now stay hidden when there's only 1 language available
- Language select list is now sorted in alphabetical order
- Site logo is now clickable and points to home page
- Added advertisement space to mobile version

V2.3.8
- Added option to add custom pages and tabs
- Added expiration date to admin uploads page
- Added recaptcha to normal user login
- Improved loading of animated icons

V2.3.7
- Fixed issue where incorrect file sizes where shown on the download page
- Fixed issue where removing file from upload selection would cause the total to reset to 0
- Fixed tab window size issue on ipad
- Fixed logging issue
- Added extra margin to captcha on contact form
- Updated French and German translation files
- Removed "Powered by Droppy" from admin page

V2.3.6
- (Modern theme) Added translation for connection issue popup
- (Modern theme) Added translation for "no expire" option
- (Modern theme) Added option to specify multiple default recipients in "Default recipients" input and added email select dropdown to upload form
- (Modern theme) Added option to hide "Share type" option from upload form
- (Modern theme) Added option to hide "Destruction" option from upload form
- (Modern theme) Added option to specify default expiration time
- (Modern theme) Fixed possible auto-fill issues on password input
- (Modern theme) Fix expiration date being shown on download page when upload expiration is disabled
- Fixed JS error in admin panel
- Fixed destruction email not being sent immediately when the upload is marked as inactive

V2.3.5
- Added upload expiration option to upload form
- Added dark mode toggle to admin panel
- Added missing "My account" page to admin panel
- Fixed issue where download link in sender email would not work
- Fixed issue in admin panel where clicking on the logo would not bring you back to the admin home page
- Fixed styling of email settings page in the admin panel
- Fixed infinte reloading issue on system page
- Fixed issue where htaccess message was incorrectly showing
- Moved upload settings to separate page in the admin panel
                </pre>
                    <p>The full changelog can be found <a href="https://proxibolt.zendesk.com/hc/en-us/articles/360025115111-Droppy-changelog" target="_blank">over here</a></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>$(document).ready(function() { $('#changelog-modal').modal('show'); });</script>
<?php endif; ?>