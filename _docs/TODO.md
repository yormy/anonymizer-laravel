typehint $protecgted

# JSON Anonymizer
When data is stored in a filed as json, the faker cannot handle this.
Idea:
create a data structure so that faker can be applied to generate the valid json
only overwrite values of the json that need to be anonymized, leave the rest as is

# Password field
You can set the password field like any other field to anonymize or set to a specific value. Laravel handles the hashing.
However as bcrypt is designed to be slow, this anonimization then becomes very very slow.
How to fix this?
