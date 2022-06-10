<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    <br>
                    Home
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <?php if(!$this->adminlib->isUpToDate()) : ?>
            <div class="alert alert-danger" style="margin: 10px 0 20px 0;">
                <h2>New update available!</h2>
                A new update is available, go to your <a href="system">system page</a> to download and install.
                <br>
            </div>
        <?php endif; ?>

        <div class="row row-cards">
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right text-green">&nbsp;</div>
                        <div class="h1 m-0"><?php echo $stats['total_uploads'] ?></div>
                        <div class="text-muted mb-4">Total uploads</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right text-green">&nbsp;</div>
                        <div class="h1 m-0"><?php echo $stats['total_uploads_active'] ?></div>
                        <div class="text-muted mb-4">Active uploads</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right text-green">&nbsp;</div>
                        <div class="h1 m-0"><?php echo $stats['total_downloads'] ?></div>
                        <div class="text-muted mb-4">Total downloads</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right text-green">&nbsp;</div>
                        <div class="h1 m-0"><?php echo $stats['total_uploads_destroyed'] ?></div>
                        <div class="text-muted mb-4">Uploads destroyed</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right text-green">&nbsp;</div>
                        <div class="h1 m-0"><?php echo $stats['total_size'] ?></div>
                        <div class="text-muted mb-4">Total uploaded</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right text-green">&nbsp;</div>
                        <div class="h1 m-0"><?php echo $stats['total_size_download'] ?></div>
                        <div class="text-muted mb-4">Total downloaded</div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-3">Using Storage <strong><?php echo $stats['total_size'] ?></strong></p>
                        <!--<div class="progress progress-separated mb-3">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 44%"></div>
                            <div class="progress-bar bg-info" role="progressbar" style="width: 19%"></div>
                            <div class="progress-bar bg-success" role="progressbar" style="width: 9%"></div>
                        </div>
                        <div class="row">
                            <div class="col-auto d-flex align-items-center pe-2">
                                <span class="legend me-2 bg-primary"></span>
                                <span>Regular</span>
                                <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">915MB</span>
                            </div>
                            <div class="col-auto d-flex align-items-center px-2">
                                <span class="legend me-2 bg-info"></span>
                                <span>System</span>
                                <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">415MB</span>
                            </div>
                            <div class="col-auto d-flex align-items-center px-2">
                                <span class="legend me-2 bg-success"></span>
                                <span>Shared</span>
                                <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">201MB</span>
                            </div>
                            <div class="col-auto d-flex align-items-center ps-2">
                                <span class="legend me-2"></span>
                                <span>Free</span>
                                <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">612MB</span>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
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
                            <dd class="col-7"><?php echo $settings['site_url'] ?></dd>
                            <dt class="col-5">Droppy version</dt>
                            <dd class="col-7"><?php echo $settings['version'] ?></dd>
                            <dt class="col-5">PHP version</dt>
                            <dd class="col-7"><?php echo phpversion() ?></dd>
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
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>