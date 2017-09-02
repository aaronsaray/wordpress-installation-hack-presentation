# WordPress Unattended Install Hack Demonstration

These are the supporting files to demonstrate how someone can overtake/hack
a WordPress installation waiting to be installed without the owner realizing it.

## Initial Setup

Run the Docker Compose functionality to launch the proper containers:

`docker-compose up`

Add the following line to your `/etc/hosts` file to make it easier to demonstrate:

`127.0.0.1 goodguy.com`

## Steps to Attack

1. Using Bad Guy's browser, load up the WordPress site at http://goodguy.com:9080 to demonstrate it requires installation
2. Progress through and put in `badguy.com` as the mysql host, `hacked_wordpress` as the database, username `root`, password `password`
3. Finish install
4. Login with `badguy` with password of `hacker`
5. Go to plugins and upload plugin from `badguy/sources/wordpress-plugin/hack-website.php`
6. Activate plugin
7. Note how the site is back to being installed
8. Using Good Guy's browser, run the installation process.
9. As Bad Guy, request a URL and add `n4v4ac=bHMgLWxh` to the GET parameter - show that the result of `ls -la` was on the bottom of the page

## Explanation

1. WordPress is waiting for you to install - you'll use a local database server to configure it.
2. Bad guy finds the hosting, points it to his own database which already has an install. He configured a super basic mysql dump with his known username and password.
3. WordPress recognizes it has already been installed (it doesn't want to blow away your old site if you had to 'reinstall')
4. Bad Guy now authenticates against his remote mysql database but on the local server.
5. Uploads a malicious plugin - activates it - it delivers its payload - then it deletes itself.  It also deletes wp-config.php.
6. The payload appended a special check for a GET request - and since its on any page at all, he can choose which page to use to process his code
7. Since wp-config.php was deleted, the wordpress instance is back to square one - ready to be installed - looks "fresh"
8. That special code executes whatever he base-64 encoded and sent as a GET parameter - in our case, we're using passthru so that it's easier to demonstrate

## Ways to Make it Harder to Stop

I didn't want to make this too cut & paste, but I still wanted to demonstrate enough to show how easy/important it was.
Because of this, here are a list of ways that we could make it harder to detect, but I haven't implemented.

- Don't use passthru - use something like exec()
- When the plugin deletes itself, it could delete the folder, too.
- Don't append to index.php because a wordpress update could change it.  Write to wp-config.php instead because that's less likely to be changed I think.
- Or pick a set of random filenames that look official, and write the code there.  Then, you would have to go to just that special URL but it'd wouldn't be deleted.
- File could change it's filename every time it was requested - sending back it's new filename in a header of the request
- Check complicated-standalone.php to show how we could make the get parameter pretty random looking
- Check obfuscate to show how we could obfuscate the code that was written to the file
- To stop things that scan for checksums and crc's, the payload code and/or the actual zip file itself can have extra random information added to them to make it easier to just point and scan

## Inspiration

I've assisted a number of people cleaning up hacked website files, so I was familiar with some of the ways to obfuscate and confuse.  The
idea to attack WordPress in this manner was directly inspired by [this Defcon 2016 talk](https://media.defcon.org/DEF%20CON%2025/DEF%20CON%2025%20presentations/DEFCON-25-Hanno-Boeck-Abusing-Certificate-Transparency-Logs.pdf).
