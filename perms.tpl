#!/bin/sh
group=_www

sudo chgrp -R $group storage/logs storage/framework storage/app storage/media-library bootstrap/cache database/snapshots
sudo chmod -R ugo+rwx storage/logs storage/framework storage/app storage/media-library bootstrap/cache database/snapshots
sudo chgrp -R $group .
sudo chmod -R g+rwX .
find . -type d -exec chmod g+s '{}' +
