e2lj
====

[Blog Engine E2](http://blogengine.ru/) (Aegea) → [LiveJournal.com](http://livejournal.com/) crosspost system.

## Installation
  — upload `e2lj` path on server,  
  — upload `e2lj.tmpl.php` and `e2lj-publish.tmpl.php` into `themes/theme/templates/` or `system/theme/templates/`,  
  — replace the following code in `…/theme/templates/main.tmpl.php`: 
  ```php
    <? if ($content['sign-in']['done?']) { ?>
      <? _CSS ('admin') ?>
      <? _JS ('admin') ?>
    <? } ?>
  ```
  with 
  ```php
    <? if ($content['sign-in']['done?']) { ?>
      <? _CSS ('admin') ?>
      <? _JS ('admin') ?>
      <? _JS('e2lj/e2lj') ?>
      <? _CSS('e2lj/e2lj') ?>
    <? } ?>
  ```

## Using in themes
If you are using the default theme by Ilya Birman, you can simply replace your files in `system/theme/templates/` with mine.

But if not, follow instructions below:  
  — To create form on **note page**, use this construction anywhere in `../theme/templates/notes.tmpl.php`:  
```php
  <? if (@$note['published?'] and !$content['pages']['timeline?']): ?>
    <? _T('e2lj') ?>
  <? endif ?>
```
  — To create form on **draft page**, use this construction anywhere in `../theme/templates/form-note-publish.tmpl.php`:  
```php
  <? _T('e2lj-publish') ?>
```

Both will generate default forms of posting to LiveJournal.
By default, form are rather smart. It will ask you username and/or password of your livejournal, if they don't called in `e2lj/configure.php`. 

But if you don't like this form and you want to make it yourself, you should call a function, that will pass all needed parameters to the server:
```js
  e2lj(prompt('Enter your login'), prompt('Enter your password'), 'h1.e2-smart-title', '.text.published', '.tags');
```

If you defined your password in configure-file, just use:
```js
  e2lj(false, false, 'h1.e2-smart-title', '.text.published', '.tags');
```

All needed params:
```js
  @return boolean
  e2lj(string @login, string @password, string @titleSelector, string @articleSelector, string @tagsSelector);
```

## Configuration
**e2lj** has its own configuration file in `e2lj/configuration.php`.
You will find an array with following parameters:  
  — `enable-e2lj` — Enable script  
      **true** or **false** (false by default)  
  
  — `login` — login in lj-system (will display an input on **false**,**empty** or **not defined**)  
  — `init-login` — default value in input (shows only when `login` false, empty, undefined)  
  — `password` — password (see login)  
  — `init-password` — default value in input (see init-login)  
  
  — `text-on-button` — text on button  
  — `text-on-publish` — text near button on publish  
  
  — `entry-prefix` — will prepend article text  
  — `entry-postfix` — will append article text  
  
  — `import-tags` — parse or not tags  
    **true** or **false** (false on empty)  
  — `permanent-tags` — permanent tags will append article tags  
    
  — `additional-settings` — **array** (look `props` in p2lj() https://github.com/rozzy/p2lj#p2lj)
## Under the hood
What about engine?

At **server side** it works very simply. With the help of [p2lj](https://github.com/rozzy/p2lj) we send all needed data to livejournal's servers.
It needs at least 4 required params for work:
```php
  p2lg(
    $login, //@string
    $password, //@string
    $title, //@string
    $message, //@string
    $features //@array [optional]
  )
```

I don't recommend you to edit backend-files, but do it for your own risk.

What about **client-side**?  
It's little bit interesting. When you pass all needed params to `e2lj()`, it will parse all your data and create an JSON-array for sending on server.
This JSON will include:  
  — `password`  
  — `title`  
  — `message`  
  — `tags`  
  — `otherInfo` (JSON-array, look `props` in p2lj() https://github.com/rozzy/p2lj#p2lj)    
  — `currentPage`: `window.location.href`  
  — `send`: `post` (required params)  

What about tags?
Hmm, i thought and thought and in final i have wrote a smart function, that parses data of your element and make it readable.

There is an little example.
Imagine, that you have tags-structure like in default theme:
```html
  <div class="tags">
    <a href="#">babushka</a> &nbsp; 
    <a href="#">vodka</a> &nbsp; 
    <a href="#">bears</a>  
  </div>
```
My function will collect all between your `a`–tags and output it as «babushka,vodka,bears».
You should call only `e2lj(login, pass, 'h1', '.article', '.tags')`.

What if you have something like this:
```html
  <span class="tags"><a href="#">babushka</a>, <a href="#">vodka</a>, <a href="#">bears</a>.</span>
```
Nothing special, it will clean your line from unnecessary symbols like `,` and `.` in the end. You should only define attribute `data-output="line"`.
```html
  <span class="tags" data-output="line"><a href="#">babushka</a>, <a href="#">vodka</a>, <a href="#">bears</a>.</span>
```
