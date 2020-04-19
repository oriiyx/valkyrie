<?php

use WebsiteEntries\WebsiteEntries;

require_once 'autoFileImporter.php';
require_once 'head.php';


?>
<div id="page-top">
    <div id="wrapper">

		<?php
		include_once 'side-bar.php';
		?>

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <form id="submit-website-addition">
                                <div class="form-group" id="form-adding-websites">
                                    <div class="col-sm-12">
                                        <label for="formName">Website name</label>
                                    </div>
                                    <div class="form-row align-items-center website-url-entry-wrap">
                                        <div class="col-sm-5">
                                            <input type="url" class="form-control website-url-entry" id="website-url-0"
                                                   data-entry="id-0" name="website-url[]"
                                                   placeholder="Enter website url">
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control website-name-entry"
                                                   id="website-name-0"
                                                   name="website-name[]" placeholder="Enter website name">
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-danger remove-me" data-remove="id-0">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <button id="add-more" name="add-more" class="btn btn-primary mb-2">Add More</button>
                                <input type="button" name="submit" id="submit" value="Save" class="btn btn-primary mb-2"
                                       id="save-data-adding-websites"/>
                            </form>
                        </div>

                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
	        <?php
	        include_once 'footer.php';
	        ?>
            <!-- End of Footer -->

        </div>
    </div>
</div>

