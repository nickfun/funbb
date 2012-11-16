#!/bin/sh
sudo chgrp -R www-data storage
sudo chmod -R g+w storage
echo "permissions changed for storage/"