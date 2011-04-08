require "bundler/deployment"
Bundler::Deployment.define_task(self)

set :application, "travelerserv"
set :repository,  "git@github.com:kated/travelerserv.git"
set :deploy_to, "/var/www/rails/travelerserv"
set :user, application
set :use_sudo, false

set :scm, :git

set :bundle_without,  [:development, :test]
set :bundle_dir, ""
set :rake, "bundle exec rake"

role :web, "geogremlin.geog.ucsb.edu"                          # Your HTTP server, Apache/etc
role :app, "geogremlin.geog.ucsb.edu"                          # This may be the same as your `Web` server
role :db,  "geogremlin.geog.ucsb.edu", :primary => true # This is where Rails migrations will run

# if you're still using the script/reaper helper you will need
# these http://github.com/rails/irs_process_scripts

before "deploy:restart", "bundle:install"
before "deploy:migrate", "bundle:install"

namespace :deploy do
   task :start do ; end
   task :stop do ; end
   task :restart, :roles => :app, :except => { :no_release => true } do
     run "touch #{File.join(current_path,'tmp','restart.txt')}"
   end
end