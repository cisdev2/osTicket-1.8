CISTicket
========

Modifications done to osTicket for the Centre for Instructional Support's (at UBC) helpdesk system.

To view the files that have changed from osTicket, stay on this branch (cisticket) and view the commits since the branch was created (since commit [c18eac40de95458ef3c6291f5f7bb7543bb1d086](https://github.com/cisdev2/osTicket-1.8/commit/c18eac40de95458ef3c6291f5f7bb7543bb1d086) ).

Some key changes to note:
- Course Number capture and search (see separate section below)
- Integrated the UBC CLF to the client front-end (added the stylesheets and changed the header/footer include files for the client view)
- Added some REGEXs to remove the "quoted/from/to" fields when emails are replied to
- Changed "ticket" to "request" in all client views
- Changed the front page so everything is edited through the admin panel
- Disabled the rich text editor on page editing in the admin panel (to allow for arbitrary HTML)
- Changed the open.php client page so if an `id` is passed through the URL, the form will pre-select the category (this in effect gives us a separate page for each type of request if we want to send people there directly)
- Form styling changes (different colors, spacing/padding/margin, removed the red submit button effect, changed the look of the processing popup)
- Removed the "draft saving" or "draft error" popups to avoid confusing faculty
- In general, most new CSS is added in unit.css (to avoid editing the core CLF and OsTicket themes)

Course number capture and search
--------------------------

General idea:
- To create new "search-able" items, they need to be added to the "additional request details" form and **have to be dropdowns**
- Since we want to put the department and course number higher in the form, we put them there and then duplicate their values into some hidden fields
- To deal with numbers, there are three digit dropdowns corresponding to the three digits of the course

Key technical points:
- The "additional request details" form must have fields with variables ***"xoo", "oxo", and "oox"*** that are all dropdowns of "digits" to catch the course number values
- The "Contact info" form needs to have field with variable "program" that has a dropdown of "programs" (used to inject the department name into the course)
- The "additional request details" form must have a field with variable "deptnamecopy" that is a dropdown of "programs" (the dept name will get copied here from the above point so we can search by it)
- Any form that wants to make use of course search needs to have a field for the course number with the following details (THESE ARE MUSTS): 
  - Variable: ***courseno*** (this is how the code recognizes that this is the special number box)
  - Visibility: required
  - Configuration options: size=3,max-length=3,
  - Configuration regex: /\d\d\d/iu  (from the / to the u, inclusive)
  - Recommended help-text: "If your request involves many courses, use the the lowest course number and list the rest in additional information. If your course has a suffix or refers to a specific section,  enter it under the additional information."
  - Recommended error-message: "Please enter 3 digits. See the help text for more info."
- If no course number field is included, the ticket will still be searchable by department and will be tagged [DEPT] instead of [DEPT XXX]

Client side: 
- Modified the code that generates the form to add CSS classes to the special form items. Some of these classes cause the (duplicate) fields to be hidden visually (but they are still in the form)
- Added some Javascript that copies the department in the first dropdown into all the appropriate places (including the hidden fields)
- Added some Javascript that takes the digits the user enters and injects them into the 3 digit dropdowns (which are hidden from the user)

Staff side:
- Added a form in the HTML to serve as the course search
- Added Javascript that takes the form entry, parses it, injects it into the hidden advanced search form (hidden by default) and then triggers the hidden "submit" button

Original README
--------------------------

***The following is the original osTicket README from where the branch was created:***

osTicket
========
<a href="http://osticket.com"><img src="http://osticket.com/sites/default/files/osTicket.jpg"
align="left" hspace="10" vspace="6"></a>

**osTicket** is a widely-used open source support ticket system. It seamlessly
integrates inquiries created via email, phone and web-based forms into a
simple easy-to-use multi-user web interface. Manage, organize and archive
all your support requests and responses in one place while providing your
customers with accountability and responsiveness they deserve.

How osTicket works for you
--------------------------
  1. Users create tickets via your website, email, or phone
  1. Incoming tickets are saved and assigned to agents
  1. Agents help your users resolve their issues

osTicket is an attractive alternative to higher-cost and complex customer
support systems; simple, lightweight, reliable, open source, web-based and
easy to setup and use. The best part is, it's completely free.

Requirements
------------
  * HTTP server running Microsoft® IIS or Apache
  * PHP version 5.3 or greater
  * mysqli extension for PHP
  * MySQL database version 5.0 or greater

### Recommendations
  * gd, gettext, imap, json, mbstring, and xml extensions for PHP
  * APC module enabled and configured for PHP

Deployment
----------
osTicket now supports bleeding-edge installations. The easiest way to
install the software and track updates is to clone the public repository.
Create a folder on you web server (using whatever method makes sense for
you) and cd into it. Then clone the repository (the folder must be empty!):

    git clone https://github.com/osTicket/osTicket-1.8 .

And deploy the code into somewhere in your server's www root folder, for
instance

    cd osTicket-1.8
    php setup/cli/manage.php deploy --setup /var/www/htdocs/osticket/

Then you can configure your server if necessary to serve that folder, and
visit the page and install osTicket as usual. Go ahead and even delete
setup/ folder out of the deployment location when you’re finished. Then,
later, you can fetch updates and deploy them (from the folder where you
cloned the git repo into)

    git pull
    php setup/cli/manage.php deploy -v /var/www/htdocs/osticket/

Upgrading
---------
osTicket supports upgrading from 1.6-rc1 and later versions. As with any
upgrade, strongly consider a backup of your attachment files, database, and
osTicket codebase before embarking on an upgrade.

To trigger the update process, fetch the osTicket-1.8 tarball from either
the osTicket [github](http://github.com/osTicket/osTicket-1.8/releases) page
or from the [osTicket website](http://osticket.com). Extract the tarball
into the folder of your osTicket codebase. This can also be accomplished
with the zip file, and a FTP client can of course be used to upload the new
source code to your server.

Any way you choose your adventure, when you have your codebase upgraded to
osTicket-1.7, visit the /scp page of you ticketing system. The upgrader will
be presented and will walk you through the rest of the process. (The couple
clicks needed to go through the process are pretty boring to describe).

**WARNING**: If you are upgrading from osTicket 1.6, please ensure that all
    your files in your upload folder are both readable and writable to your
    http server software. Unreadable files will not be migrated to the
    database during the upgrade and will be effectively lost.

View the UPGRADING.txt file for other todo items to complete your upgrade.

Help
----
Visit the [wiki](http://osticket.com/wiki/Home) or the
[forum](http://osticket.com/forums/). And if you'd like professional help
managing your osTicket installation,
[commercial support](http://osticket.com/support/) is available.

Contributing
------------
Create your own fork of the project and use
[git-flow](https://github.com/nvie/gitflow) to create a new feature. Once
the feature is published in your fork, send a pull request to begin the
conversation of integrating your new feature into osTicket.

### Localization
[![Crowdin](https://d322cqt584bo4o.cloudfront.net/osticket-official/localized.png)](http://i18n.osticket.com/project/osticket-official)

The interface for osTicket is now completely translatable. Language packs
are available on the [download page](http://osticket.com/download). If you
do not see your language there, join the [Crowdin](http://i18n.osticket.com)
project and request to have your language added. Languages which reach 100%
translated are are significantly reviewed will be made available on the
osTicket download page.

Localizing strings in new code requires usage of a [few rules](setup/doc/i18n.md).

License
-------
osTicket is released under the GPL2 license. See the included LICENSE.txt
file for the gory details of the General Public License.

osTicket is supported by several magical open source projects including:

  * [Font-Awesome](http://fortawesome.github.com/Font-Awesome/)
  * [HTMLawed](http://www.bioinformatics.org/phplabware/internal_utilities/htmLawed)
  * [jQuery dropdown](http://labs.abeautifulsite.net/jquery-dropdown/)
  * [mPDF](http://www.mpdf1.com/)
  * [PasswordHash](http://www.openwall.com/phpass/)
  * [PEAR](http://pear.php.net/package/PEAR)
  * [PEAR/Auth_SASL](http://pear.php.net/package/Auth_SASL)
  * [PEAR/Mail](http://pear.php.net/package/mail)
  * [PEAR/Net_SMTP](http://pear.php.net/package/Net_SMTP)
  * [PEAR/Net_Socket](http://pear.php.net/package/Net_Socket)
  * [PEAR/Serivces_JSON](http://pear.php.net/package/Services_JSON)
  * [php-gettext](https://launchpad.net/php-gettext/)
  * [phpseclib](http://phpseclib.sourceforge.net/)
  * [Spyc](http://github.com/mustangostang/spyc)
