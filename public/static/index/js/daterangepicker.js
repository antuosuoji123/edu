/*!
 * Stylesheet for the Date Range Picker, for use with Bootstrap 3.x
 *
 * Copyright 2013-2015 Dan Grossman ( http://www.dangrossman.info )
 * Licensed under the MIT license. See http://www.opensource.org/licenses/mit-license.php
 *
 * Built for http://www.improvely.com
 */

 .daterangepicker.dropdown-menu {
  max-width: none;
  z-index: 3000;
}

.daterangepicker.opensleft .ranges, .daterangepicker.opensleft .calendar {
  float: left;
  margin: 4px;
}

.daterangepicker.opensright .ranges, .daterangepicker.opensright .calendar,
.daterangepicker.openscenter .ranges, .daterangepicker.openscenter .calendar {
  float: right;
  margin: 4px;
}

.daterangepicker.single .ranges, .daterangepicker.single .calendar {
  float: none;
}

.daterangepicker .ranges {
  width: 160px;
  text-align: left;
}

.daterangepicker .ranges .range_inputs>div {
  float: left;
}

.daterangepicker .ranges .range_inputs>div:nth-child(2) {
  padding-left: 11px;
}

.daterangepicker .calendar {
  display: none;
  max-width: 270px;
}

.daterangepicker.show-calendar .calendar {
    display: block;
}

.daterangepicker .calendar.single .calendar-date {
  border: none;
}

.daterangepicker .calendar th, .daterangepicker .calendar td {
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
  white-space: nowrap;
  text-align: center;
  min-width: 32px;
}

.daterangepicker .daterangepicker_start_input label,
.daterangepicker .daterangepicker_end_input label {
  color: #333;
  display: block;
  font-size: 11px;
  font-weight: normal;
  height: 20px;
  line-height: 20px;
  margin-bottom: 2px;
  text-shadow: #fff 1px 1px 0px;
  text-transform: uppercase;
  width: 74px;
}

.daterangepicker .ranges input {
  font-size: 11px;
}

.daterangepicker .ranges .input-mini {
  border: 1px solid #ccc;
  border-radius: 4px;
  color: #555;
  display: block;
  font-size: 11px;
  height: 30px;
  line-height: 30px;
  vertical-align: middle;
  margin: 0 0 10px 0;
  padding: 0 6px;
  width: 74px;
}

.daterangepicker .ranges ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

.daterangepicker .ranges li {
  font-size: 13px;
  background: #f5f5f5;
  border: 1px solid #f5f5f5;
  color: #08c;
  padding: 3px 12px;
  margin-bottom: 8px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  cursor: pointer;
}

.daterangepicker .ranges li.active, .daterangepicker .ranges li:hover {
  background: #08c;
  border: 1px solid #08c;
  color: #fff;
}

.daterangepicker .calendar-date {
  border: 1px solid #ddd;
  padding: 4px;
  border-radius: 4px;
  background: #fff;
}

.daterangepicker .calendar-time {
  text-align: center;
  margin: 8px auto 0 auto;
  line-height: 30px;
}

.daterangepicker {
  position: absolute;
  background: #fff;
  top: 100px;
  left: 20px;
  padding: 4px;
  margin-top: 1px;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}

.daterangepicker.opensleft:before {
  position: absolute;
  top: -7px;
  right: 9px;
  display: inline-block;
  border-right: 7px solid transparent;
  border-bottom: 7px solid #ccc;
  border-left: 7px solid transparent;
  border-bottom-color: rgba(0, 0, 0, 0.2);
  content: '';
}

.daterangepicker.opensleft:after {
  position: absolute;
  top: -6px;
  right: 10px;
  display: inline-block;
  border-right: 6px solid transparent;
  border-bottom: 6px solid #fff;
  border-left: 6px solid transparent;
  content: '';
}

.daterangepicker.openscenter:before {
  position: absolute;
  top: -7px;
  left: 0;  
  right: 0;
  width: 0;
  margin-left: auto;
  margin-right: auto;
  display: inline-block;
  border-right: 7px solid transparent;
  border-bottom: 7px solid #ccc;
  border-left: 7px solid transparent;
  border-bottom-color: rgba(0, 0, 0, 0.2);
  content: '';
}

.daterangepicker.openscenter:after {
  position: absolute;
  top: -6px;
  left: 0;  
  right: 0;  
  width: 0;
  margin-left: auto;
  margin-right: auto;
  display: inline-block;
  border-right: 6px solid transparent;
  border-bottom: 6px solid #fff;
  border-left: 6px solid transparent;
  content: '';
}

.daterangepicker.opensright:before {
  position: absolute;
  top: -7px;
  left: 9px;
  display: inline-block;
  border-right: 7px solid transparent;
  border-bottom: 7px solid #ccc;
  border-left: 7px solid transparent;
  border-bottom-color: rgba(0, 0, 0, 0.2);
  content: '';
}

.daterangepicker.opensright:after {
  position: absolute;
  top: -6px;
  left: 10px;
  display: inline-block;
  border-right: 6px solid transparent;
  border-bottom: 6px solid #fff;
  border-left: 6px solid transparent;
  content: '';
}

.daterangepicker.dropup{
  margin-top: -5px;
}
.daterangepicker.dropup:before{
  top: initial;
  bottom:-7px;
  border-bottom: initial;
  border-top: 7px solid #ccc;
}
.daterangepicker.dropup:after{
  top: initial;
  bottom:-6px;
  border-bottom: initial;
  border-top: 6px solid #fff;
}

.daterangepicker table {
  width: 100%;
  margin: 0;
}

.daterangepicker td, .daterangepicker th {
  text-align: center;
  width: 20px;
  height: 20px;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  cursor: pointer;
  white-space: nowrap;
}

.daterangepicker td.off {
  color: #999;
}

.daterangepicker td.disabled, .daterangepicker option.disabled {
  color: #999;
}

.daterangepicker td.available:hover, .daterangepicker th.available:hover {
  background: #eee;
}

.daterangepicker td.in-range {
  background: #ebf4f8;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
}

.daterangepicker td.start-date {
  -webkit-border-radius: 4px 0 0 4px;
  -moz-border-radius: 4px 0 0 4px;
  border-radius: 4px 0 0 4px;
}

.daterangepicker td.end-date {
  -webkit-border-radius: 0 4px 4px 0;
  -moz-border-radius: 0 4px 4px 0;
  border-radius: 0 4px 4px 0;
}

.daterangepicker td.start-date.end-date {
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}

.daterangepicker td.active, .daterangepicker td.active:hover {
  background-color: #357ebd;
  border-color: #3071a9;
  color: #fff;
}

.daterangepicker td.week, .daterangepicker th.week {
  font-size: 80%;
  color: #ccc;
}

.daterangepicker select.monthselect, .daterangepicker select.yearselect {
  font-size: 12px;
  padding: 1px;
  height: auto;
  margin: 0;
  cursor: default;
}

.daterangepicker select.monthselect {
  margin-right: 2%;
  width: 56%;
}

.daterangepicker select.yearselect {
  width: 40%;
}

.daterangepicker select.hourselect, .daterangepicker select.minuteselect, .daterangepicker select.secondselect, .daterangepicker select.ampmselect {
  width: 50px;
  margin-bottom: 0;
}

.daterangepicker_start_input {
  float: left;
}

.daterangepicker_end_input {
  float: left; 
  padding-left: 11px
}

.daterangepicker th.month {
  width: auto;
}