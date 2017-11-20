##Community Guidelines

This file contains some guidelines for working on this repo.

#Unchanged files

Some files exist in this repository that should be assumed-unchanged at all times. This is because they either contain sensitive information such as database passwords, or are local files such as error logs.
To keep the repo clean and to prevent possible security issues for those working on it, here is a list of files that should be `assumed-unchanged` after cloning the repo.

/error.log
/lib/config.default.php
/installer/dbcreds.php

To add these files to the assume-unchanged list use: `git update-index --assume-unchanged file.name`
