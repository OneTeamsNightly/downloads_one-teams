<?if(!$oneteam)exit();?>
<?
function getSize($bytes, $decimals = 2) {
    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)).' '.$size[$factor];
}
?>
<br><a href="#" data-device="<?=$device;?>" class="btn waves-effect waves-light indigo back"><i class="mdi-hardware-keyboard-backspace"></i> Rom Listesine Geri Dön</a><br><br>
<?$files=glob('OTA_Files/'.$device.'/'.$rom.'/*.zip');if(count($files) !=0){
usort($files, create_function('$a,$b', 'return filemtime($b) - filemtime($a);'));
?>
<table class="responsive-table display" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Dosya</th>
                            <th>Boyut</th>
                            <th>Yüklenme Tarihi</th>
                            <th>CRC</th>
                        </tr>
                    </thead>
                 
                    <tfoot>
                        <tr>
                            <th width="40%">Dosya</th>
                            <th width="14%">Boyut</th>
                            <th width="18%">Yüklenme Tarihi</th>
                            <th width="28%">MD5 Checksum</th>
                        </tr>
                    </tfoot>
                 
                    <tbody>
					<?foreach($files as $file){?>
                        <tr>
                            <td><a href="?device=<?=$device;?>&rom=<?=$rom;?>&download=<?=base64_encode(str_replace(['OTA_Files/'.$device.'/'.$rom.'/','.zip'],null,$file));?>"><?=str_replace('OTA_Files/'.$device.'/'.$rom.'/',null,$file);?></a></td>
                            <td><?=getSize(filesize($file));?></td>
                            <td><?=date("d/m/Y H:i:s",filemtime($file));?></td>
                            <td><?=md5_file($file);?></td>
                        </tr>
					<?}?>
                    </tbody>
                  </table>
<?}else{?>
<div id="card-alert" class="card pink lighten-5">
                      <div class="card-content pink-text darken-1">
                        <span class="card-title pink-text darken-1"><i class="mdi-alert-error"></i> Hata!</span>
                        <p>Bu Rom Geçerli Cihaz İçin Derlenmemiş.</p>
                      </div>
                    </div>
					<br><br><br><br><br><br><br><br><br><br><br><br>
<?}?>