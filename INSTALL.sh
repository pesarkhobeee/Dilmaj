#!/usr/bin/env bash

cp dilmaj /usr/bin
sed -i "s,'./','/usr/lib/dilmaj/',g" /usr/bin/dilmaj
chmod +x /usr/bin/dilmaj
mkdir /usr/lib/dilmaj
cp dilmaj.php bidi.php persian_log2vis.php unicode_data.php  /usr/lib/dilmaj
sed -i "s,'./','/usr/share/dilmaj/',g" /usr/lib/dilmaj/dilmaj.php 
mkdir /usr/share/dilmaj
cp DejaVuSans.ttf generic.xdb /usr/share/dilmaj

echo "INSTALLATION FINISHED"
