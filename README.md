# PackageFactory.OffRoad

> Remap your Routes in Flow and Neos

## Why?

Providing the correct URL structure that fits all needs for a representative website can sometimes be hard, irritating
and illogcal. Since a system like Neos follows a tree structure to organize documents and contents, it is kind of bound
to display the resulting document routes as a reflection of that structure. And by doing so, Neos provides us with a
whole lot of stability and reliability.

But sometimes the purpose of organisation can conflict with the purpose of representation. Sometimes parts of the tree
structure seem redundant or misplaced when they display as part of the URL.

To teach Neos how to handle those exceptions would be painful, because it would take away an awful lot of meaning from
the system.

So why not just configure those exceptions in a decorating process above the entire Neos (and Flow) routing layer?

**This is where OffRoad comes in ;)**

## Configuration

Just configure your routes in your Settings.yaml as follows:

```yaml
PackageFactory:
  OffRoad:
    mapping:
      '/different/route': '/route/to/target.html'
```

Now `/different/route` will lead to the content that was formerly displayed at `/route/to/target.html`.

### What happens with the original URIs when I hit them directly?

OffRoad takes care to redirect these URLs with a 301 status code to their intended destination.

## License

Copyright (c) 2015 Wilhelm Behncke (wilhelm.behncke@googlemail.com)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.  IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
