

<?php
class phpUploadAddImages
{

function addGDLogoLicense($filename="",$logoLicense){
					$x = 0;
					$y = 0;
					$fileName = $filename;
					$img=imagecreatefromJpeg($fileName);
					list($imgW,$imgH)=getimagesize($fileName) ;
					$dimgW =$imgW / 2; 
					$dimgH =$imgH / 2;
					$fileLogo = $logoLicense;
					list($logoW,$logoH)=getimagesize($fileLogo) ;
					$dlogoW =$logoW / 2; 
					$dlogoH =$logoH / 2;
					$x	=$dimgW	  -  $dlogoW;
					$y	=$dimgH   -  $dlogoH;

					$logo=imagecreatefrompng($fileLogo);
					//-Set logo Transparent
					imagecolortransparent($logo,ImageColorAt($logo, 0, 0));
					// Add Image License
					imagecopymerge ($img, $logo,$x,$y,0,0,$logoW,$logoH,30);
					// Replace images
					imageJpeg($img,$filename,95);
					imagedestroy($img);
					imagedestroy($logo);
}


}
// Call Function
//addGDLogoLicense("aaa.jpg","dupimg.png");
?>