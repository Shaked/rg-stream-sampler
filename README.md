## Stream Sampler - Description

In different scenarios its hard to know the size of a possible list of items, therefore, it is required to randomly choose k samples from the list (where n is either a very large or unknown number).

There are probably more ways to solve this issue but I have focused on 2 common algorithms:

- The first algorithm is simple but less efficient, especially for a large number of k samples. The complexity of the algorithm is O(K^2) as a result of a in-loop search.

- The second algorithm is called [Reservoir Sampling](https://en.wikipedia.org/wiki/Reservoir_sampling) which is known for this type of problems. Having said that, this algorithm might be tricky when it comes to multi threading and a large number of K. The complexity of the algorithm is O(N).

[![Build Status](https://travis-ci.org/Shaked/rg-stream-sampler.png?branch=master)](https://travis-ci.org/Shaked/rg-stream-sampler)
[![Coverage Status](https://coveralls.io/repos/Shaked/rg-stream-sampler/badge.png)](https://coveralls.io/r/Shaked/rg-stream-sampler)

## Usage

First install dependencies:
```
make install
```

If installed, you can use ```make update``` later on.

The sampler supports 3 input methods:

### Piped command line input (STDIN)

```
./bin/rg-stream-sampler -i THEQUICKBROWNFOXJUMPSOVERTHELAZYDOG
```

### Self randomized strings

Using the `-r` you can decide what would be the size of the random text

```
./bin/rg-stream-sampler -r 10
```

### Loading values remotely

```
./bin/rg-stream-sampler -i "https://www.random.org/strings/?num=1000&len=20&digits=on&upperalpha=on&loweralpha=on&unique=on&format=plain&rnd=new"
```

The default algorithm is Reservoir Sampling. You can choose to use the sequence one by adding `-a seq`.

## Testing

In order to run the tests you should run the following commands:

```
make install //if not installed already
make test
```

Coverage is also available using ```make cover``` (and it will open the browser directly after). This won't work on PHP 7 as [xdebug](http://xdebug.org/download.php) is/was not available at the time of writing it.

## Benchmarking

As I have decided to use 2 algorithms, it might worth showing the benchmark results:

```
Sampler\Benchmarks\ReservoirEvent
    Method Name             Iterations    Average Time      Ops/second
    ---------------------  ------------  --------------    -------------
    benchReservoir10k    : [1,000     ] [0.2484058105946] [4.02567]
    benchReservoir100k   : [1,000     ] [0.2644526109695] [3.78140]
    benchReservoir1000k  : [1,000     ] [0.2710286958218] [3.68965]
    benchReservoir10000k : [500       ] [0.2710664744377] [3.68913]
    benchReservoir100000k: [10        ] [0.2284299612045] [4.37771]


Sampler\Benchmarks\SequenceEvent
    Method Name            Iterations    Average Time      Ops/second
    --------------------  ------------  --------------    -------------
    benchSequence10k    : [1,000     ] [0.1142126736641] [8.75560]
    benchSequence100k   : [1,000     ] [0.1222488436699] [8.18004]
    benchSequence1000k  : [1,000     ] [0.1420348870754] [7.04052]
    benchSequence10000k : [10        ] [2.5817480802536] [0.38733]
    benchSequence100000k: [1         ] [298.1928839683533] [0.00335]
```

You can run the benchmarks yourself using ```make bench```.

Note that the benchmarks take time, so in case you wish to change it, you can go to [benchmark directory](/src/Sampler/Benchmarks/) and change the annotation accordingly.


## TODO

### Unicode Support

At the moment there is no unicode support. One clear example is the use of [str_split](http://php.net/manual/en/function.str-split.php "str_split — Convert a string to an array") which:
 > str_split() will split into bytes, rather than characters when dealing with a multi-byte encoded string. (php.net)