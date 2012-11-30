#!/usr/bin/perl
##############################################################################
# Countdown                     Version 1.21                                 #
# Copyright 1996 Matt Wright    mattw@scriptarchive.com                      #
# Created 9/1/95                Last Modified 10/8/95                        #
# Scripts Archive at:           http://www.scriptarchive.com/                #
##############################################################################
# COPYRIGHT NOTICE                                                           #
# Copyright 1996 Matthew M. Wright  All Rights Reserved.                     #
#                                                                            #
# Countdown may be used and modified free of charge by anyone so long as     #
# this copyright notice and the comments above remain intact.  By using this #
# code you agree to indemnify Matthew M. Wright from any liability that      #  
# might arise from it's use.                                                 #  
#                                                                            #
# Selling the code for this program without prior written consent is         #
# expressly forbidden.  In other words, please ask first before you try and  #
# make money off of my program.                                              #
#                                                                            #
# Obtain permission before redistributing this software over the Internet or #
# in any other medium.	In all cases copyright and header must remain intact.#
##############################################################################
# Define Variables

# @from_date = (yyyy,mm,dd,hh,mm,ss);
# Which means: (year,month,day,hour,minute,second)
@from_date = (2000,1,1,0,0,0);

# Done
##############################################################################

$ENV{'QUERY_STRING'} =~ s/%2C/,/g;
$ENV{'QUERY_STRING'} =~ s/=//g;

if ($ENV{'QUERY_STRING'}) {
   @from_date = split(/,/, $ENV{'QUERY_STRING'});
}

# Define when various things occur, different dates, etc...
&define_dates;

# Calculate the Differences in the two dates
&calc_dates;

# Make Sure we don't get negative times.. That's not cool...
&no_negative;

# Top of HTML Page Information
&html_header;

# We don't want it to say 1 Years, now, do we?  Of course not!
&proper_english;

# End of HTML Page Information
&html_trailer;

#####################################
# Subroutines

sub define_dates {
   ($f_year,$f_month,$f_day,$f_hour,$f_minute,$f_second) = @from_date;

   ($second,$minute,$hour,$day,$month,$year,$wday,$yday,$isdst) = localtime(time);

   $year += 1900;

   &leap_year_check;

   @months = ("XX","January","February","March","April","May","June","July",
              "August","September","October","November","December");

   @days = ("XX","1st","2nd","3rd","4th","5th","6th","7th","8th","9th","10th",
            "11th","12th","13th","14th","15th","16th","17th","18th","19th",
            "20th","21st","22nd","23rd","24th","25th","26th","27th","28th",
            "29th","30th","31st");

   @days_in_month = (31,$feb_days,31,30,31,30,31,31,30,31,30,31);

   $date_term = "$months[$f_month] $days[$f_day]";

   unless ($f_year eq 'XX') {
      $date_term = "$date_term, $f_year";
   }
   unless ($f_hour eq 'XX') {
      $date_term = "$date_term $f_hour";
   }
   unless ($f_minute eq 'XX') {
      if ($f_minute < 10) {
         $date_term = "$date_term:0$f_minute";
      }
      else {
         $date_term = "$date_term:$f_minute";
      }
   }
   unless ($f_second eq 'XX') {
      if ($f_second < 10) {
         $date_term = "$date_term:0$f_second";
      }
      else {
         $date_term = "$date_term:$f_second";
      }
   }

   $current_date = "$months[($month + 1)] $days[$day], $year $hour";
   if ($minute < 10) {
      $current_date = "$current_date:0$minute";
   }
   else {
      $current_date = "$current_date:$minute";
   }
   if ($second < 10) {
      $current_date = "$current_date:0$second";
   }
   else {
      $current_date = "$current_date:$second";
   }

}

sub leap_year_check {
   if ($year % 4 != 0 || ($year % 100 == 0 && $year % 400 != 0)) {
      $feb_days = "28";
   }
   else {
      $feb_days = "29";
   }
}

sub calc_dates {
   $real_year = ($f_year - $year);
   $real_month = (($f_month - 1) - $month);
   $real_day = ($f_day - $day);
   $real_hour = ($f_hour - $hour);
   $real_minute = ($f_minute - $minute);
   $real_second = ($f_second - $second);
}

sub no_negative {
   if ($real_second < 0) {
      $real_second = ($real_second + 60);
      $real_minute--;
   }

   if ($real_minute < 0) {
      $real_minute = ($real_minute + 60);
      $real_hour--;
   }

   if ($real_hour < 0) {
      $real_hour = ($real_hour + 24);
      $real_day--;
   }

   if ($real_day < 0) {
     $real_day = ($real_day + @days_in_month[$month]);
      $real_month--;
   }

   if ($real_month < 0) {
      $real_month = ($real_month + 12);
      $real_year--;
   }
}

sub proper_english {
   unless ($f_year eq 'XX') {
      if ($real_year eq '1') {
         print "$real_year Year<br>\n";
      } else {
         print "$real_year Years<br>\n";
      }
   }

   unless ($f_month eq 'XX') {
      if ($real_month eq '1') {
         print "$real_month Month<br>\n";
      } else {
         print "$real_month Months<br>\n";
      }
   }

   unless ($f_day eq 'XX') {
      if ($real_day eq '1') {
         print "$real_day Day<br>\n";
      } else {
         print "$real_day Days<br>\n";
      }
   }

   unless ($f_hour eq 'XX') {
      if ($real_hour eq '1') {
         print "$real_hour Hour<br>\n";
      } else {
         print "$real_hour Hours<br>\n";
      }
   }

   unless ($f_minute eq 'XX') {
      if ($real_minute eq '1') {
         print "$real_minute Minute<br>\n";
      } else {
         print "$real_minute Minutes<br>\n";
      }
   }

   unless ($f_second eq 'XX') {
      if ($real_second eq '1') {
         print "$real_second Second<br>\n";
      } else {
         print "$real_second Seconds<br>\n";
      }
   }


}

sub html_header {
   print "Content-type: text/html\n\n";
   print "<html><head><title>Countdown to: $date_term</title></head>\n";
   print "<body><center><h1>Countdown to: $date_term</h1>\n";
   print "<hr>\n";
}

sub html_trailer {
   print "<hr>\n";
   print "It is currently $current_date\n";
   print "</center>\n";
   print "</body></html>\n";
}
