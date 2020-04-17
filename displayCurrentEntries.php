<?php

use DisplayWebsiteEnitres\DisplayWebsiteEnitres;

require_once './autoFileImporter.php';

$entries = new DisplayWebsiteEnitres();
$entries = $entries->displayInformationFromAllEntries();

var_dump($entries);

?>

<div class="row">

<?php
foreach ( $entries as $item ) {
	?>
    <div class="col-sm-4 mb-4">
    <div class="card">
        <div class="card-body">
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
    </div><?php
}

?>
</div>
