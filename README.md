## Formz

formz is a Form building extra that allows you to get forms up and running on your website.
You can store the information inside the database or send a email and store in database.

## How to Export

First, clone this repository somewhere on your development machine:

`git clone http://github.com/silentworks/formz.git ./`

Then, create the target directory where you want to create the file.

Then, navigate to the directory formz is now in, and do this:

`git archive HEAD | (cd /path/where/I/want/my/new/repo/ && tar -xvf -)`

(Windows users can just do git archive HEAD and extract the tar file to wherever
they want.)

Then you can git init or whatever in that directory, and your files will be located
there!

## Configuration

Now, you can create some System Settings:

- 'formz.core_path' - Point to /path/to/formz/core/components/formz/
- 'formz.assets_url' - /path/to/formz/assets/components/formz/

Then clear the cache. This will tell the Extra to look for the files located
in these directories, allowing you to develop outside of the MODx webroot!

## Requirements

Install using Manager Package Management

FormIt <http://modx.com/extras/package/formit>

FormItFastPack <http://modx.com/extras/package/formitfastpack>

## Installing From Package

If you are installing from the package provided inside the packages directory, just copy the file into your
MODX core/packages directory and then do find file locally inside of your Manager Package Management interface.

Once the package is installed you can setup a template variable and assign the __formz__ input type and output type to it.
Go to a page that has the template variable assigned to its template, and you should now have an empty dropdown menu.

You can now start to create Forms by going to the components menu __Formz Builder__.

## Feedback
Any comments or issues please raise that using the ticketing system, do remember this Extra is still in its early stages.
I would not recommend using on a live site if the Extra is still in alpha.
