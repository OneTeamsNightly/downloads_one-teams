<?if(!$oneteam)exit();?>
<?
$romNames=json_decode(file_get_contents('data/roms.json'),true);
$versions=[
'n'=>'Nougat',
'm'=>'Marshmallow',
'l'=>'Lollipop'
];
if(count(glob(('OTA_Files/'.$device.'/*'))) !=0){
?>
					<br><div class="row">
					<div class="col s12 m4 l3"><img src="assets/devices/<?=$device;?>.png"></div>
					<div class="col s12 m8 l9">
					<h4 id="deviceName"></h4><br>
					<ul class="collapsible collapsible-accordion" data-collapsible="accordion">
					<?foreach($versions as $version_id=>$version){$roms=glob('OTA_Files/'.$device.'/*_'.$version_id);if(count($roms)===0)continue;?>
  <li>
    <div class="collapsible-header"><?=$version;?></div>
    <div class="collapsible-body">
	<div class="collection">
	<?foreach($roms as $rom_id){$rom_id=explode('_',str_replace('OTA_Files/'.$device.'/',null,$rom_id))[0];?>
    <a href="#" class="collection-item" data-device="<?=$device;?>" data-rom="<?=$rom_id;?>_<?=$version_id;?>"><i class="mdi-action-android"></i> <span><?=$romNames[$rom_id];?></span></a>
					<?}?>
    </div>
    </div>
  </li>
					<?}?>
</ul>
				
					</div>
					</div><br>
<?}else{?>
<br><div id="card-alert" class="card pink lighten-5">
                      <div class="card-content pink-text darken-1">
                        <span class="card-title pink-text darken-1"><i class="mdi-alert-error"></i> Hata!</span>
                        <p>Bu Cihaz İçin Uygun Rom Bulunamadı.</p>
                      </div>
                    </div>
					<br><br><br><br><br><br><br><br><br><br><br><br><br>
<?}?>