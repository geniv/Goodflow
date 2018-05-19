#!/usr/bin/perl
# set the perl environment variable PATH
#$ENV{'PATH'} = '/bin:/usr/bin:/home/fred/bin';
print $ENV{'PATH'};

foreach $key (keys(%ENV)) {

    printf("%-10.10s: $ENV{$key}\n", $key);

}
