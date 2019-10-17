#!/bin/bash
cd ..
php bin/console messenger:consume job-direct1-transport job-direct2-transport job-direct-keys-transport job-fanout 
