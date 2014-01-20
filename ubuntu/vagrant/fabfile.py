from fabric.api import run
from fabric.api import sudo
from fabric.utils import puts
from fabric.colors import red, green
from fabric.context_managers import *

import cuisine

cuisine.select_package("apt")

def kernel_name():
	puts(green('Confirming Operation System'))
	run('uname -a')

def setup():
	_setup_ubuntu()
	_setup_devtools()

def _setup_ubuntu():
	puts(green('Setting Operation System'))
	sudo("cp /usr/share/zoneinfo/Japan /etc/localtime")
	sudo("apt-get update")

def _setup_devtools():
	puts(green('Installing Devtools'))
	cuisine.package_ensure('vim')
	cuisine.package_ensure('python-setuptools')
