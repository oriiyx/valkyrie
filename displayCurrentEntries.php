<?php

use DisplayWebsiteEnitres\DisplayWebsiteEnitres;

require_once './autoFileImporter.php';

$entries = new DisplayWebsiteEnitres();
$entries = $entries->displayInformationFromAllEntries();

?>

<?php
foreach ( $entries as $item ) {
	?>
    <div class="col-sm-4 mb-4" id="<? echo $item["db-entry"] ?>">
    <div class="card <?php echo ($item['ping_code'] == 200 ? 'border-left-success' : 'border-left-danger')  ?> shadow h-100 py-2">
        <div class="card-body">
	        <div class="row no-gutters align-items-center">
		        <div class="col mr-2">
                    <button type="button" class="close close-website-entry" aria-label="Close" data-close="<? echo $item["db-entry"] ?>">
                        <span aria-hidden="true">&times;</span>
                    </button>
		            <h5 class="card-title"><?php echo $item['name'] ?></h5>
		            <h6 class="card-subtitle mb-2 text-muted"><?php echo $item['url'] ?></h6>
					<?php
					if ( $item['ping_code'] == 200 ) {
						?>
						<div class="alert alert-success" role="alert">
						    <img src="./assets/icons/tick.png" /> Currently online
						</div>
						<?php
					}else{
						?>
						<div class="alert alert-danger" role="alert">
							<img src="./assets/icons/close.png" /> Currently offline
						</div>
						<?php
					}
					?>
		        </div>
	        </div>
        </div>
    </div>
    </div><?php
}

?>