# -*- mode: ruby -*-
# vi: set ft=ruby :
# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'"
  config.vm.box = "ubuntu/trusty64"
  config.vm.network :private_network, ip: "192.168.68.99"
  config.vm.synced_folder "./", "/home/vagrant/project", type: "nfs"
  
  config.vm.provider :virtualbox do |vb|
     vb.gui = false
     vb.customize ["modifyvm", :id, "--memory", "1536"]
     vb.name = "symfony-cali"
     vb.cpus = 2
  end
  
  config.vm.provision :shell, :path => "bootstrap.sh"
   
end
