# WordPress Unattended Install Hack Demonstration

These are the supporting files to demonstrate how someone can overtake/hack
a WordPress installation waiting to be installed without the owner realizing it.

## Initial Setup

Run the Docker Compose functionality to launch the proper containers:

`docker-compose up`

## Steps to Attack

1. Load up the WordPress site at http://localhost:9080 to demonstrate it requires installation
2. Progress through and put in `badguy.com:9306` as the mysql host, `hacked_wordpress` as the database, username `root`, password `password`
3. Finish install
4. Login with `badguy` with password of `hacker`





@todo add the inspired link from teh defcon talk
