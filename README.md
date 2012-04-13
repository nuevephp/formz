## FormbuilderX

FormbuilderX is a Form building extra that allows you to get forms up and running on your website.
You can store the information inside the database or send a email and store in database.

## How to Export

First, clone this repository somewhere on your development machine:

`git clone http://github.com/silentworks/FormbuilderX.git ./`

Then, create the target directory where you want to create the file.

Then, navigate to the directory FormbuilderX is now in, and do this:

`git archive HEAD | (cd /path/where/I/want/my/new/repo/ && tar -xvf -)`

(Windows users can just do git archive HEAD and extract the tar file to wherever
they want.)

Then you can git init or whatever in that directory, and your files will be located
there!

## Configuration

Now, you'll want to change references to FormbuilderX in the files in your
new copied-from-FormbuilderX repo to whatever name of your new Extra will be. Once
you've done that, you can create some System Settings:

- 'mynamespace.core_path' - Point to /path/to/my/extra/core/components/extra/
- 'mynamespace.assets_url' - /path/to/my/extra/assets/components/extra/

Then clear the cache. This will tell the Extra to look for the files located
in these directories, allowing you to develop outside of the MODx webroot!

## Information

Note that if you git archive from this repository, you may not need all of its
functionality. This Extra is setup to do the following:

- Integrates some custom tables to store form data
- A snippet to display the form on your website
- A custom manager page to manage Forms
