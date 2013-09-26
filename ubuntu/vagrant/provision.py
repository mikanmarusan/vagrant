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
	_setup_devtools()
	_setup_packages()

	_configuration_apache2()

	_restart_daemons()

def _setup_devtools():
	puts(green('Installing Devtools'))
	cuisine.package_ensure('vim')
	cuisine.package_ensure('python-setuptools')

def _setup_packages():
	puts(green('Installing Packages'))
	cuisine.package_ensure('libapache2-mod-wsgi')
	cuisine.package_ensure('apache2-mpm-worker')

def _configuration_apache2():
	sudo('cp /vagrant/hello /etc/apache2/sites-available/hello')
	if not cuisine.file_exists('/etc/apache2/sites-enabled/hello'):
		sudo('a2ensite hello')

def _restart_daemons():
	puts(green('Restarting Daemons'))
	cuisine.upstart_ensure('apache2')
	#sudo('/etc/init.d/apache2 restart')
