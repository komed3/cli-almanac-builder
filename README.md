# cli-almanac-builder v 1.01

PHP almanac builder for CLI

## Requirements

cli-almanac-builder requires PHP to run on terminal (Windows and Linux tested)

## Usage

+ download or clone repository
+ create new ``output`` directory
+ start ``cli-almanac-builder.php`` from CLI with year to build
+ get almanac from output directory

## Customisation

### ``config/free.json``

Events and holidays for almanac builder:

+ ``events``: holidays indicated in the Almanac by their name
+ ``holidays``: school holidays, shown with a different coloured background

```json
{
  "events": {
    "2022-01-01": "New Year’s Day",
    ...
  },
  "holidays": [
    { "from": "2021-12-20", "to": "2022-01-03" },
    ...
  ]
}
```

### ``config/names.json``

Change output language for week day (starts with sonday) and month names.

### ``config/moon.json``

Moon phases for almanac builder.

## Example

```console
$ php cli-almanac-bilder.php 2022

[12/21/2021 08:35:13] load names
[12/21/2021 08:35:13] load holiday data
[12/21/2021 08:35:13] load moon data
[12/21/2021 08:35:13] build almanac for year 2022
[12/21/2021 08:35:13] build page 1 of 2
[12/21/2021 08:35:13] build month 1 of 2022
[12/21/2021 08:35:13] build month 2 of 2022
[12/21/2021 08:35:13] build month 3 of 2022
[12/21/2021 08:35:13] build month 4 of 2022
[12/21/2021 08:35:13] build month 5 of 2022
[12/21/2021 08:35:13] build month 6 of 2022
[12/21/2021 08:35:13] output page 1
[12/21/2021 08:35:13] build page 2 of 2
[12/21/2021 08:35:13] build month 7 of 2022
[12/21/2021 08:35:13] build month 8 of 2022
[12/21/2021 08:35:13] build month 9 of 2022
[12/21/2021 08:35:13] build month 10 of 2022
[12/21/2021 08:35:13] build month 11 of 2022
[12/21/2021 08:35:13] build month 12 of 2022
[12/21/2021 08:35:13] output page 2
```
