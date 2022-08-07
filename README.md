
# PWA migration

From old versions and old hosting.


### Problem 1

"Local storage" data is only tied to a given hostname. So moving whole data to _new_ hostnames isn't all too pleasant.


### Problem 2

I didn't bake in versioning from the start. Or least I don't remember how or if I did it before it was all too late. In short, identifying the _version_ of the persistent store is not straightforward. Converting between them is also somewhat interesting.


## The approach

1. A simple JS script replaces the old PWA.
2. If no data is present it redirects immediately to the new host.
3. Otherwise it identifies the version and converts it appropriately.
4. It then submits form data to the new hosting.
5. The migration script on the new hosting dumps this into the local store.
6. A redirect/refresh into to the (new) PWA root hydrates the data into the app.
7. ???
8. profit.


## Deploy

```
git add remote production app@fieldassistant.app:migration
git push production master
```
