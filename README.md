Markdowner
==========

Markdowner is PHP Markdown reader based on PHP Markdown Lib by Michel Fortin

Introduction
------------

I know it is easy to read markdown

Usage
-----

TBD


Public API and Versioning Policy
---------------------------------

Version numbers are of the form *major*.*minor*.*patch*.

The public API of PHP Markdown consist of the two parser classes `Markdown`
and `MarkdownExtra`, their constructors, the `transform` and `defaultTransform`
functions and their configuration variables. The public API is stable for
a given major version number. It might get additions when the minor version
number increments.

**Protected members are not considered public API.** This is unconventional
and deserves an explanation. Incrementing the major version number every time
the underlying implementation of something changes is going to give
nonessential version numbers for the vast majority of people who just use the
parser.  Protected members are meant to create parser subclasses that behave in
different ways. Very few people create parser subclasses. I don't want to
discourage it by making everything private, but at the same time I can't
guarantee any stable hook between versions if you use protected members.

**Syntax changes** will increment the minor number for new features, and the
patch number for small corrections. A *new feature* is something that needs a
change in the syntax documentation. Note that since PHP Markdown Lib includes
two parsers, a syntax change for either of them will increment the minor
number. Also note that there is nothing perfectly backward-compatible with the
Markdown syntax: all inputs are always valid, so new features always replace
something that was previously legal, although generally nonsensical to do.

Copyright and License
---------------------

Markdowner
Copyright (c) 2013 PT Sagara Xinix Solusitama
<http://xinix.co.id/>
All rights reserved.

MIT License

TBD