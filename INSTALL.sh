#!/usr/bin/env bash

cp dilmaj /usr/bin
chmod +x /usr/bin/dilmaj
mkdir /usr/lib/dilmaj
cp dilmaj.php bidi.php persian_log2vis.php unicode_data.php  /usr/lib/dilmaj
mkdir /usr/share/dilmaj
cp DejaVuSans.ttf generic.xdb /usr/share/dilmaj

echo "INSTALLATION FINISHED"
