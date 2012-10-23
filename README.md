The Panel of Lamb by dc414 - https://dc414.org/

An open source alternative to Wall of Sheep.

#### WEBUI Setup
* Create a mysql database using the structure found in _mysql.db_
* edit _service.php_ with your mysql credentials and database

#### Automated sheep hearder
There is an included ettercap.rb in _automate/_ for parsing a ettercap log and posting lambs to the panel.

Have ettercap log to a file ``# ettercap -Tq -m sniff.log`` then pipe it through ettercap.rb ``tail -f sniff.log | ruby -n automate/ettercap.rb``

You'll need to modify ettercap.rb with the correct URL to service.php
