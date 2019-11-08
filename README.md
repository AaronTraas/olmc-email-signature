# OLMC email signature generator

PHP app that grabs data from a Google Sheet with the following format:

- row 1 and 2: header
- rows 3+
  - col A: name (not null)
  - col B: grade or department
  - col C: title
  - col D: email address (not null)

Rows where either name or email are null will be ignored.
