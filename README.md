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
