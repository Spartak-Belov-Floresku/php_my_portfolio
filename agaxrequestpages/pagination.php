<h2 class="titlecodes">JSP, Ajax, Servlet, MySQL, JSON get Results Paged</h2>

<p class="descriptioncode">
Here you will receive a pagination with JAVA, JSON, and core Ajax. 
We will not be using any 3rd party frameworks or code libraries for JavaScript to accomplish this 
task so that we may pass along the highest level of programming education and core.
</p>
<h3 class="coderef">Assuming that the users want to downloadin data from the following table</h3><br>
<h3 class="coderef">(MySQL script):</h3>
<code>
<span class="code-elem">
create database shope;<br><br>
 
use shope;<br><br>
 
CREATE TABLE <span class="code-brown">`catalogsearch_fulltext`</span> (<br>
&nbsp;&nbsp;&nbsp;<span class="code-brown">`id`</span> int(<span class="code-phptags">11</span>) NOT NULL AUTO_INCREMENT,<br>
&nbsp;&nbsp;&nbsp;<span class="code-brown">`product`</span> TEXT DEFAULT NULL,<br>
&nbsp;&nbsp;&nbsp;PRIMARY KEY (<span class="code-brown">`id`</span>)<br>
) ENGINE=InnoDB DEFAULT CHARSET=utf-8<br><br><br>

INSERT INTO <span class="code-comment">`catalogsearch_fulltext`</span> (<span class="code-comment">`id`</span>, <span class="code-comment">`product`</span>) VALUES<br>
( <span class="code-phptags">36459</span>, <span class="code-comment">'OMI-18881.05|Omix-Ada|Taxable Goods|T14 Maindrive Gear 67-75 CJ|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|T14 Maindrive Gear 10.5 1967-1975 Jeep CJ By Omix-ADA|124.99|1'</span>),<br>
( <span class="code-phptags">36458</span>, <span class="code-comment">'OMI-ULT-E7TZ4234B|Omix-Ada|Taxable Goods|Axle Shaft Ford 33-1/16in|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|31-spline chromoly rear axle shaft, left side, 87-96 2/4WD Ford F-150/Bronco, 87-97 Ford 2/4WD E-150 van with 8.8 rear axle. 33-1/16-inches long.|136.99|1'</span>),<br>
( <span class="code-phptags">36456</span>, <span class="code-comment">'OMI-ULT-E3TZ4234E|Omix-Ada|Taxable Goods|Axle Shaft Ford 33-1/16in 31SP|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|This rear axle shaft from Omix-ADA fits 83-86 Ford 2WD/4WD F-150s and Broncos with a 31-spline 8.8-inch rear axle. 33-1/16 inches long. Left side.|136.99|1'</span>),<br>
( <span class="code-phptags">36457</span>, <span class="code-comment">'OMI-ULT-E7TZ4234A|Omix-Ada|Taxable Goods|Axle Shaft Ford 31-1/16in|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|31-spline chromoly rear axle shaft right 87-96 2WD/4WD Ford F-150, Bronco, 87-97 Ford 2WD/4WD E-150 van with 8.8 rear axle. 31 1/16-inches long|136.99|1'</span>),<br>
( <span class="code-phptags">36455</span>, <span class="code-comment">'OMI-ULT-E3TZ4234D|Omix-Ada|Taxable Goods|Axle Shaft Ford 31-1/16in 31SP|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|Right rear chromoly axle shaft fits 83-86 Ford Broncos and 2WD/4WD F-150s with a 31-spline 10-bolt 8.8 inch rear axle. 31-1/16 inches long.|136.99|1'</span>),<br>
( <span class="code-phptags">36453</span>, <span class="code-comment">'OMI-ULT-E3TZ4234B|Omix-Ada|Taxable Goods|Axle Shaft Ford RH 26-1/4IN|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|This 28-spline chromoly right rear axle shaft fits 83-92 Ford Rangers and Bronco IIs with a 10 bolt 7.5 inch rear axle. 26-1/4 inches long|136.99|1'</span>),<br>
( <span class="code-phptags">36454</span>, <span class="code-comment">'OMI-ULT-E3TZ4234C|Omix-Ada|Taxable Goods|Axle Shaft Ford LH 29-1/8in|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|This 28-spline left rear axle shaft fits 83-92 2WD/4WD Ford Rangers and Bronco IIs with a 10 bolt 7.5 inch rear axle. 29-1/8 inches long.|136.99|1'</span>),<br>
( <span class="code-phptags">36451</span>, <span class="code-comment">'OMI-ULT-4137429|Omix-Ada|Taxable Goods|Axle Shaft Dodge 31-5/8in|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|This 31-spline chromoly rear axle shaft fits 84-93 Dodge 2WD/4WD W-100 and W-150 Pickup and Ramchargers with a 9.25 inch rear differential.|136.99|1'</span>),<br>
( <span class="code-phptags">36452</span>, <span class="code-comment">'OMI-ULT-D6TZ4234A|Omix-Ada|Taxable Goods|Axle Shaft Ford|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|This chromoly rear axle shaft from Omix-ADA fits 74-86 Ford F-series Pickup with a 9-inch rear differential. Fits left or right sides.|136.99|1'</span>),<br>
( <span class="code-phptags">36443</span>, <span class="code-comment">'OMI-ULT-14042690|Omix-Ada|Taxable Goods|Axle Shaft GM R 33-5/16 28SP|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|This 30-spline chromoly rear axle shaft from Omix-ADA fits 75-88 GM 2WD 1/2-ton and 79-88 GM 2WD 3/4-ton vans with a 12 bolt rear axle.|136.99|1'</span>),<br>
( <span class="code-phptags">36444</span>, <span class="code-comment">'OMI-ULT-14071750|Omix-Ada|Taxable Goods|Shaft Axle LH=RH|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|This chromoly rear axle shaft from Omix-ADA fits 71-81 GM 4WD Blazers and Suburbans with a 30-spline 12 bolt rear axle. Fits left/right. 31-5/16-In|136.99|1'</span>),<br>
( <span class="code-phptags">36445</span>, <span class="code-comment">'OMI-ULT-14071751|Omix-Ada|Taxable Goods|Axle Shaft GM R 31-5/16 30SP|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|This chromoly rear axle shaft from Omix-ADA fits 71-81 GM 2WD Blazers and Suburbans with a 30-spline 12 bolt rear axle. Fits left/right. 31-5/16-In|136.99|1'</span>),<br>
( <span class="code-phptags">36446</span>, <span class="code-comment">'OMI-ULT-26010414|Omix-Ada|Taxable Goods|Axle Shaft|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|30-spline chromoly rear axle shaft fits 88-91 GM 4WD 1500 Pickup, Suburbans, Jimmys, Blazers with a 6 lug 10 bolt rear axle. 31-5/16 inches long.|136.99|1'</span>),<br>
( <span class="code-phptags">36447</span>, <span class="code-comment">'OMI-ULT-26013313|Omix-Ada|Taxable Goods|Axle Shaft GM R 33-5/8 30SP|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|This 30-spline chromoly rear axle shaft from Omix-ADA fits 88-95 1/2 and 3/4 ton 2WD GM vans with an 10-bolt 8.5-inch rear axle. 33-5/8 inches long.|136.99|1'</span>),<br>
( <span class="code-phptags">36448</span>, <span class="code-comment">'OMI-ULT-26013882|Omix-Ada|Taxable Goods|Axle Shaft GM R 29in 28SP 7.5|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|This 28-spline chromoly rear axle shaft from Omix-ADA fits 88-98 GM Pickup and SUVs. 29 inches long. Fits left or right sides.|136.99|1'</span>),<br>
( <span class="code-phptags">36449</span>, <span class="code-comment">'OMI-ULT-3969285|Omix-Ada|Taxable Goods|Axle Shaft R GM12|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|This 30-spline chromoly rear axle shaft from Omix-ADA fits 70-72 Chevy Camaros and 68-72 Chevelles with a 12 bolt rear axles. Fits left or right side.|136.99|1'</span>),<br>
( <span class="code-phptags">36450</span>, <span class="code-comment">'OMI-ULT-3969349|Omix-Ada|Taxable Goods|Axle Shaft R GM12|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|This chromoly rear axle shaft from Omix-ADA fits 65-67 Chevy Chevelles, 68-72 Chevelle IIs, and 67-69 Camaros with a 12-bolt rear axle.|136.99|1'</span>),<br>
( <span class="code-phptags">36430</span>, <span class="code-comment">'RR-TL-12804.35|Rugged Ridge|Taxable Goods|Cover Tire 35in Tread Lightly|Show your support for Tread Lightly with great new branded vinyl Tire Covers from Rugged Ridge. Custom designed to fit today''s most popular sized tires. Constructed of durable vinyl coated polyester fabric. Please measure tire diameter to ensure proper fitment. A portion of the proceeds from each sale go to support Tread Lightly and its mission to promote responsible outdoor recreation through ethics education and stewardship programs. For more information please visit: www.treadlightly.org|This black 35-36 inch Tread Lightly! tire cover from Rugged Ridge protects your spare tire and shows your support for Tread Lightly!|39.92|1'</span>),<br>
( <span class="code-phptags">36431</span>, <span class="code-comment">'RR-TL-13122.01|Rugged Ridge|Taxable Goods|Tub Storage|Omix-ADA is an Official Partner of Tread Lightly We offer over 100 applications to date. TreadLightly plays a pivotal role in keeping the balance between all of our business needs (like our niche Jeep and truck aftermarket segment) and the outdoor ethics, for now and the future. A portion from the Tread Lightly Floor Liner sales will be donated to TreadLightly Ordering is simple, add in front of any of our floor liners'' part number. For example Front JK will be under TL-12901.01.|This Tread Lightly! edition rear cargo area storage bin from Rugged Ridge fits 07-10 Jeep Wrangler (JK).|55.92|1'</span>),<br>
( <span class="code-phptags">36432</span>, <span class="code-comment">'RR-TL-13551.40|Rugged Ridge|Taxable Goods|Trash Bin Seatback Tl|Seat back removable trash bin by Rugged Ridge, Tread Lightly logo, black, universal application|This Tread Lightly! edition removable seat back trash bag from Rugged Ridge fits any high back seat.|20.72|1'</span>),<br>
( <span class="code-phptags">36433</span>, <span class="code-comment">'OMI-TLC-529-ZG|Omix-Ada|Taxable Goods|Toy Landcruiser Rear Ring Pin|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|Ring and Pinion Gear Set, Toyota Landcruiser, Rear By Omix-ADA|460.99|1'</span>),<br>
( <span class="code-phptags">36434</span>, <span class="code-comment">'PG-TOY/411T|Precision Gear|Taxable Goods|Ring/Pinion 8 200Mm 4.11 V6/Tu|Precision Gear had its beginning over 25 years ago developing specialty application ring and pinion gear sets for race cars and off road vehicles. By continually applying the same performance criteria to each new product, Precision Gear has steadily grown and now offers the industry''s largest selection of specialty gears. We also have a full line of high performance gears sets, bearing kits and locking differentials.|Toyota 8 (200mm) 4.11 V6/Turbo By Precision Gear|452.99|1'</span>),<br>
( <span class="code-phptags">36412</span>, <span class="code-comment">'OMI-RE14MCC5|Omix-Ada|Taxable Goods|Spark Plug 02-05|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|Spark Plug (Resistor, Copper Core), 2003-2006 Wrangler (2.4L), 2002-2005 Liberty (2.4L)|3.99|1'</span>),<br>
( <span class="code-phptags">36413</span>, <span class="code-comment">'OMI-RE14PLP5|Omix-Ada|Taxable Goods|Spark Plug JK 07-11|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|Spark Plug (Resistor, Platinum), 2007-2011 Wrangler (3.8L)|14.99|1'</span>),<br>
( <span class="code-phptags">36414</span>, <span class="code-comment">'OMI-RFN14LY|Omix-Ada|Taxable Goods|Spark Plug 78-90|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|Spark Plug Resistor, Copper, 80-83 CJ5 4.2, 83 CJ5 2.5, 80-86 CJ7 4.2, 83-86 CJ7 2.5, 81-86 CJ8 4.2, 83-86 CJ8 2.5, 87-90 YJ, 84-85 XJ 2.5, 78-87 SJ|3.99|1'</span>),<br>
( <span class="code-phptags">36415</span>, <span class="code-comment">'OMI-RJ8C|Omix-Ada|Taxable Goods|Spark Plug 45-71|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|Spark Plug (Non Resistor, Copper Core), 45-49 CJ2A, 48-53 CJ3A, 53-67 CJ3B, 52-71 M38A1, 55-71 CJ5, 55-71 CJ6, 46-64 Truck, 46-64 Station Wagon|3.99|1'</span>),<br>
( <span class="code-phptags">36416</span>, <span class="code-comment">'OMI-RN12YC|Omix-Ada|Taxable Goods|Spark Plug|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|Spark Plug (Resistor, Copper Core), 1984-1986 Cherokee (2.8L), 1993-1996 Grand Cherokee (5.2L)|3.99|1'</span>),<br>
( <span class="code-phptags">36417</span>, <span class="code-comment">'OMI-RN13LYC|Omix-Ada|Taxable Goods|Spark Plug 78-87|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|Spark Plug (Non Resistor, Copper Core), 1978-1979 CJ5 (3.8L and 4.2L), 1978-1979 CJ7 (3.8L and 4.2L), 1978-1987 (SJ) (4.2L, 5.9L and 6.6L)|3.99|1'</span>),<br>
( <span class="code-phptags">36418</span>, <span class="code-comment">'OMI-RN14MC5|Omix-Ada|Taxable Goods|Spark Plug Champion 3.1L 3.3L|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|SPARK PLUG, CHAMPION, DODGE / CHRYSLER MINI VAN, TOWN and COUNTY, CARAVAN, GRAND CARAVAN 91-00 WITH 3.1L OR 3.3L|3.99|1'</span>),<br>
( <span class="code-phptags">36419</span>, <span class="code-comment">'OMI-RN14YC|Omix-Ada|Taxable Goods|Spark Plug 72-88|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|Spark Plug,74-83 SJ 4.2 5.9,72-81 CJ5 3.8L 4.2L 5.0L,72-75 CJ6 3.8L 4.2L 5.0L,76-81 CJ7 3.8L 4.2L 5.0L,65-83 Wagoneer 3.8L 4.2L 5.0L|3.99|1'</span>),<br>
( <span class="code-phptags">36420</span>, <span class="code-comment">'OMI-RV12YC|Omix-Ada|Taxable Goods|Spark Plug 84-96|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|Spark Plug (Resistor, Copper Core), 1984-1986 Cherokee (2.8L), 1993-1996 Grand Cherokee (5.2L)|3.99|1'</span>),<br>
( <span class="code-phptags">36421</span>, <span class="code-comment">'OMI-RV17YC6|Omix-Ada|Taxable Goods|Spark Plug 80-83|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|Spark Plug (Resistor, Copper Core), 1980-1983 CJ5 (2.5L GM), 1980-1983 CJ7 (2.5L GM), 1981-1983 CJ8 (2.5L GM)|3.99|1'</span>),<br>
( <span class="code-phptags">36422</span>, <span class="code-comment">'PG-SET20|Precision Gear|Taxable Goods|Bearing Component|Precision Gear had its beginning over 25 years ago developing specialty application ring and pinion gear sets for race cars and off road vehicles. By continually applying the same performance criteria to each new product, Precision Gear has steadily grown and now offers the industry''s largest selection of specialty gears. We also have a full line of high performance gears sets, bearing kits and locking differentials.|Bearing Component By Precision Gear|98.99|1'</span>),<br>
( <span class="code-phptags">36423</span>, <span class="code-comment">'PG-TAC/456|Precision Gear|Taxable Goods|Toyota 8 (210Mm) 4.56 Tacoma|Precision Gear had its beginning over 25 years ago developing specialty application ring and pinion gear sets for race cars and off road vehicles. By continually applying the same performance criteria to each new product, Precision Gear has steadily grown and now offers the industry''s largest selection of specialty gears. We also have a full line of high performance gears sets, bearing kits and locking differentials.|Toyota 8 (210Mm) 4.56 Tacoma By Precision Gear|308.99|1'</span>),<br>
( <span class="code-phptags">36424</span>, <span class="code-comment">'PG-TAC/456R|Precision Gear|Taxable Goods|Toyota 7 1/2 (190Mm) 4.56 Tac|Precision Gear had its beginning over 25 years ago developing specialty application ring and pinion gear sets for race cars and off road vehicles. By continually applying the same performance criteria to each new product, Precision Gear has steadily grown and now offers the industry''s largest selection of specialty gears. We also have a full line of high performance gears sets, bearing kits and locking differentials.|Toyota 7 1/2 (190Mm) 4.56 Tac By Precision Gear|300.99|1'</span>),<br>
( <span class="code-phptags">36425</span>, <span class="code-comment">'PG-TAC/529|Precision Gear|Taxable Goods|Toyota 8 (210Mm) 5.29 Tacoma|Precision Gear had its beginning over 25 years ago developing specialty application ring and pinion gear sets for race cars and off road vehicles. By continually applying the same performance criteria to each new product, Precision Gear has steadily grown and now offers the industry''s largest selection of specialty gears. We also have a full line of high performance gears sets, bearing kits and locking differentials.|Toyota 8 (190Mm) 5.29 Tacoma By Precision Gear|452.99|1'</span>),<br>
( <span class="code-phptags">36426</span>, <span class="code-comment">'PG-TAC/529R|Precision Gear|Taxable Goods|Toyota 7 1/2 (190Mm) 5.29 Tac|Precision Gear had its beginning over 25 years ago developing specialty application ring and pinion gear sets for race cars and off road vehicles. By continually applying the same performance criteria to each new product, Precision Gear has steadily grown and now offers the industry''s largest selection of specialty gears. We also have a full line of high performance gears sets, bearing kits and locking differentials.|Toyota 7 1/2 (190Mm) 5.29 Tacoma By Precision Gear|300.99|1'</span>),<br>
( <span class="code-phptags">36427</span>, <span class="code-comment">'RR-TL-12801.01|Rugged Ridge|Taxable Goods|Covr Tire 27-29in Treadlightly|Show your support for Tread Lightly with great new branded vinyl Tire Covers from Rugged Ridge. Custom designed to fit today''s most popular sized tires. Constructed of durable vinyl coated polyester fabric. Please measure tire diameter to ensure proper fitment. A portion of the proceeds from each sale go to support Tread Lightly and its mission to promote responsible outdoor recreation through ethics education and stewardship programs. For more information please visit: www.treadlightly.org|This black 27-29 inch Tread Lightly! tire cover from Rugged Ridge protects your spare tire and shows your support for Tread Lightly!|23.44|1'</span>),<br>
( <span class="code-phptags">36428</span>, <span class="code-comment">'RR-TL-12802.01|Rugged Ridge|Taxable Goods|Covr Tire 30-32IN Treadlightly|Show your support for Tread Lightly with great new branded vinyl Tire Covers from Rugged Ridge. Custom designed to fit today''s most popular sized tires. Constructed of durable vinyl coated polyester fabric. Please measure tire diameter to ensure proper fitment. A portion of the proceeds from each sale go to support Tread Lightly and its mission to promote responsible outdoor recreation through ethics education and stewardship programs. For more information please visit: www.treadlightly.org|This black 30-32 inch Tread Lightly! tire cover from Rugged Ridge protects your spare tire and shows your support for Tread Lightly!|23.44|1'</span>),<br>
( <span class="code-phptags">36442</span>, <span class="code-comment">'OMI-ULT-14039547|Omix-Ada|Taxable Goods|Axle Shaft GM R 31-5/16 28SP|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|This 28-spline chromoly rear axle shaft from Omix-ADA fits 82-88 GM 4WD Jimmys/Blazers and 81-87 GM 1/2-ton Pickup/Suburbans with a 10 bolt axle.|136.99|1'</span>),<br>
( <span class="code-phptags">36441</span>, <span class="code-comment">'PG-TOY7/411|Precision Gear|Taxable Goods|Toyota 7 1/2 (190Mm) 4.11 Ring/Pinon|Precision Gear had its beginning over 25 years ago developing specialty application ring and pinion gear sets for race cars and off road vehicles. By continually applying the same performance criteria to each new product, Precision Gear has steadily grown and now offers the industry''s largest selection of specialty gears. We also have a full line of high performance gears sets, bearing kits and locking differentials.|Toyota 7 1/2 (190Mm) 4.11 Ring/Pinon By Precision Gear|395.99|1'</span>),<br>
( <span class="code-phptags">36440</span>, <span class="code-comment">'PG-TOY/YOKE|Precision Gear|Taxable Goods|Pinion Yoke Toyota 8 Multi-Dr|Precision Gear had its beginning over 25 years ago developing specialty application ring and pinion gear sets for race cars and off road vehicles. By continually applying the same performance criteria to each new product, Precision Gear has steadily grown and now offers the industry''s largest selection of specialty gears. We also have a full line of high performance gears sets, bearing kits and locking differentials.|Pinion Yoke Toyota 8 Multi-Dr By Precision Gear|84.99|1'</span>),<br>
( <span class="code-phptags">36439</span>, <span class="code-comment">'PG-TOY/529T|Precision Gear|Taxable Goods|Ring/Pinion 8 200Mm 5.29 V6/Turbo|Precision Gear had its beginning over 25 years ago developing specialty application ring and pinion gear sets for race cars and off road vehicles. By continually applying the same performance criteria to each new product, Precision Gear has steadily grown and now offers the industry''s largest selection of specialty gears. We also have a full line of high performance gears sets, bearing kits and locking differentials.|Toyota 8 (200Mm) 5.29 V6/Turbo By Precision Gear|452.99|1'</span>),<br>
( <span class="code-phptags">36438</span>, <span class="code-comment">'PG-TOY/529|Precision Gear|Taxable Goods|Ring/Pinion 8 200Mm 5.29|Precision Gear had its beginning over 25 years ago developing specialty application ring and pinion gear sets for race cars and off road vehicles. By continually applying the same performance criteria to each new product, Precision Gear has steadily grown and now offers the industry''s largest selection of specialty gears. We also have a full line of high performance gears sets, bearing kits and locking differentials.|Toyota 8 (200Mm) 5.29 Ring/Pinion By Precision Gear|452.99|1'</span>),<br>
( <span class="code-phptags">36437</span>, <span class="code-comment">'PG-TOY/488T|Precision Gear|Taxable Goods|Ring/Pinion 8 200Mm 4.88 V6/Turbo|Precision Gear had its beginning over 25 years ago developing specialty application ring and pinion gear sets for race cars and off road vehicles. By continually applying the same performance criteria to each new product, Precision Gear has steadily grown and now offers the industry''s largest selection of specialty gears. We also have a full line of high performance gears sets, bearing kits and locking differentials.|Toyota 8 (200Mm) 4.88 V6/Turbo By Precision Gear|253.99|1'</span>),<br>
( <span class="code-phptags">36436</span>, <span class="code-comment">'PG-TOY/488|Precision Gear|Taxable Goods|Ring/Pinion 8 200Mm 4.88|Precision Gear had its beginning over 25 years ago developing specialty application ring and pinion gear sets for race cars and off road vehicles. By continually applying the same performance criteria to each new product, Precision Gear has steadily grown and now offers the industry''s largest selection of specialty gears. We also have a full line of high performance gears sets, bearing kits and locking differentials.|Toyota 8 (200Mm) 4.88 Ring/Pinion By Precision Gear|452.99|1'</span>),<br>
( <span class="code-phptags">36435</span>, <span class="code-comment">'PG-TOY/456|Precision Gear|Taxable Goods|Ring/Pinion 8 200Mm 4.56|Precision Gear had its beginning over 25 years ago developing specialty application ring and pinion gear sets for race cars and off road vehicles. By continually applying the same performance criteria to each new product, Precision Gear has steadily grown and now offers the industry''s largest selection of specialty gears. We also have a full line of high performance gears sets, bearing kits and locking differentials.|Toyota 8 (200Mm) 4.56 Ring/Pinion By Precision Gear|452.99|1'</span>),<br>
( <span class="code-phptags">36429</span>, <span class="code-comment">'RR-TL-12803.35|Rugged Ridge|Taxable Goods|Cover Tire 33in Tread Lightly|Custom designed to fit today''s most popular sized tires. Constructed of durable vinyl coated polyester fabric. Colors match other Rugged Ridge Soft Accessories. Stylish Treadlightly Logo printed on the face.|Black Spare Tire Cover For 33 Inch Spare Tire By With Tread Lightly! Logo By Rugged Ridge|39.92|1'</span>),<br>
( <span class="code-phptags">36408</span>, <span class="code-comment">'OMI-RC7PYCB4|Omix-Ada|Taxable Goods|Spark Plug 99-04|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|Spark Plug (Resistor, Platinum), 1999-2004 Grand Cherokee (4.7L)|6.99|1'</span>),<br>
( <span class="code-phptags">36409</span>, <span class="code-comment">'OMI-RC7YC|Omix-Ada|Taxable Goods|Spark Plug 99-04|Direct OE replacement Jeep parts and accessories built to the original specifications by Omix-ADA. Limited five year Manufacturer''s warranty.|Spark Plug (Resistor, Copper Core, Heat Range 7), 1999-2004 Grand Cherokee (4.7L)|3.99|1'</span>)<br><br>
</span>
</code>

<h3 class="coderef">For easier processing we are going to add Maven dependency</h3><br>
<h3 class="coderef">pom.xml</h3>
<code>
<span class="code-elem">
&lt;dependencies&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;dependency&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;groupId&gt;javax.servlet&lt;/groupId&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;artifactId&gt;javax.servlet-api&lt;/artifactId&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;version&gt;3.1.0&lt;/version&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;scope&gt;provided&lt;/scope&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;/dependency&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;dependency&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;groupId&gt;org.glassfish.web&lt;/groupId&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;artifactId&gt;jstl-impl&lt;/artifactId&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;version&gt;1.2&lt;/version&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;/dependency&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;dependency&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;groupId&gt;mysql&lt;/groupId&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;artifactId&gt;mysql-connector-java&lt;/artifactId&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;version&gt;5.1.6&lt;/version&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;/dependency&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;dependency&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;groupId&gt;com.googlecode.json-simple&lt;/groupId&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;artifactId&gt;json-simple&lt;/artifactId&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;version&gt;1.1&lt;/version&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;/dependency&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;dependency&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;groupId&gt;com.google.code.gson&lt;/groupId&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;artifactId&gt;gson&lt;/artifactId&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;version&gt;2.8.2&lt;/version&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;/dependency&gt;<br>
&lt;/dependencies&gt;<br>
</span>
</code>

<h3 class="coderef">web.xml</h3>
<code>
<span class="code-elem">
&lt;display-name&gt;Pagination&lt;/display-name&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;welcome-file-list&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;welcome-file&gt;paginationservlet&lt;/welcome-file&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;/welcome-file-list&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;servlet&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;display-name&gt;paginationServlet&lt;/display-name&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;servlet-name&gt;paginationServlet&lt;/servlet-name&lt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;servlet-class&gt;com.controller.paginationServlet&lt/servlet-class&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;/servlet&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;servlet-mapping&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;servlet-name&gt;paginationServlet&lt;/servlet-name&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;url-pattern&gt;/paginationservlet&lt;/url-pattern&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;/servlet-mapping&gt;<br>
</span>
</code>

<h3 class="coderef">index.jsp</h3>
<code>
<span class="code-elem">
&lt;?xml <span class="code-phptags">version</span>="1.0" encoding="ISO-8859-1" ?&gt;<br>
</span>
&lt;%@ page language="java" contentType="text/html; charset=ISO-8859-1"<br>
    pageEncoding="ISO-8859-1"%&gt;<br>
<span class="code-elem">
&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;<br>
&lt;html <span class="code-phptags">xmlns</span>="http://www.w3.org/1999/xhtml"&gt;<br>
&lt;head&gt;<br>
&lt;meta <span class="code-phptags">http-equiv</span>="Content-Type" <span class="code-phptags">content</span>="text/html; <span class="code-phptags">charset</span>=ISO-8859-1" /&gt;<br>
&lt;title&gt;Pagination&lt;/title&gt;<br>
<p class="code-elem">&lt;script&gt;</p><br>

	<span class="code-comment">These two variables we are going to create in the servlet when the application will start at the first time</span><br>
	<span class="code-brown">var</span> rpp = ${rpp};<span class="code-comment">// results per page</span><br>
	<span class="code-brown">var</span> last = ${last};<span class="code-comment">// last page number</span><br><br>
	
	<span class="code-brown">function</span> request_page(pn){<br><br>
	
	&nbsp;&nbsp;&nbsp;<span class="code-brown">var</span> results_box = document.getElementById(<span class="code-comment">"results_box"</span>);<br>
	&nbsp;&nbsp;&nbsp;<span class="code-brown">var</span> pagination_controls = document.getElementById(<span class="code-comment">"pagination_controls"</span>);<br>
	
	&nbsp;&nbsp;&nbsp;results_box.innerHTML = <span class="code-comment">"loading results ..."</span>;<br>
	&nbsp;&nbsp;&nbsp;<span class="code-brown">var</span> htmlproducts = <span class="code-comment">""</span>;<br><br>
	
	&nbsp;&nbsp;&nbsp;<span class="code-brown">var</span> hr = new XMLHttpRequest();<br>
	&nbsp;&nbsp;&nbsp;hr.<span class="code-brown">open</span>(<span class="code-comment">"POST"</span>, <span class="code-comment">"paginationservlet"</span>, <span class="code-brown">true</span>);<br>
	&nbsp;&nbsp;&nbsp;hr.<span class="code-brown">setRequestHeader</span>(<span class="code-comment">"Content-type"</span>, <span class="code-comment">"application/x-www-form-urlencoded"</span>);<br><br>
	
	&nbsp;&nbsp;&nbsp;hr.onreadystatechange = function() {<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(hr.readyState == <span class="code-phptags">4</span> && hr.status == <span class="code-phptags">200</span>) {<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-brown">var</span> objson = JSON.parse(hr.responseText);<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-brown">for</span>(<span class="code-brown">var</span> p <span class="code-brown">in</span> objson){<br>
	    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-brown">var</span> productArray = objson[p].product.split(<span class="code-comment">"|"</span>);<br>
	    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;htmlproducts += <span class="code-comment">"&lt;p&gt;Id: "</span>+objson[p].id+<span class="code-comment">"&lt;br&gt;Name: "</span>+productArray[3]+<span class="code-comment">"&lt;br&gt;Price: $"</span>+productArray[productArray.length-2]+<span class="code-comment">"&lt;/p&gt;"</span>;<br>
	    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;results_box.innerHTML = htmlproducts;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;hr.send(<span class="code-comment">"rpp="</span>+rpp+<span class="code-comment">"&#38;last="</span>+last+<span class="code-comment">"&#38;pn="</span>+pn);<br><br>
	
	&nbsp;&nbsp;&nbsp;<span class="code-comment">// Change the pagination controls</span>;<br>
	&nbsp;&nbsp;&nbsp;<span class="code-brown">var</span> paginationCtrls = "";<br><br>
	
	&nbsp;&nbsp;&nbsp;<span class="code-comment">// Only if there is more than 1 page worth of results give the user pagination controls</span>;<br>
	&nbsp;&nbsp;&nbsp;<span class="code-brown">if</span>(last != <span class="code-phptags">1</span>){<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-brown">if</span> (pn > <span class="code-phptags">1</span>) {<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;paginationCtrls += <span class="code-comment">'&lt;button onclick="request_page('</span>+(pn-1)+<span class="code-comment">')"&gt; &#38;lt; &lt;/button&gt;'</span>;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;paginationCtrls += <span class="code-comment">' &#38;nbsp; &#38;nbsp; &lt;b&gt;Page '</span>+pn+<span class="code-comment">' of '</span>+last+<span class="code-comment">'&lt;/b&gt; &#38;nbsp; &#38;nbsp; '</span>;<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-brown">if</span> (pn != last) {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;paginationCtrls += <span class="code-comment">'&lt;button onclick="request_page('</span>+(pn+1)+<span class="code-comment">')"&gt;&#38;gt;&lt;/button&gt;'</span>;<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
    &nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;pagination_controls.innerHTML = paginationCtrls;<br>
	
	
}<br>
<p class="code-elem">&lt;/script&gt;</p>
<p class="code-elem">&lt;/head&gt;</p>
&lt;body&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;div <span class="code-brown">id</span>=<span class="code-comment">"pagination_controls"</span>&gt;&lt;/div&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;div <span class="code-brown">id</span>=<span class="code-comment">"results_box"</span>&gt;&lt;/div&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;script&gt; request_page(1); &lt;/script&gt;<br>
&lt;/body&gt;<br>
&lt;/html&gt;
</span>
</code>

<h3 class="coderef">paginationdServlet.java</h3>
<code>
<span class="code-phptags">package</span> com.controller;<br><br>

<span class="code-phptags">import</span> java.io.*;<br>
<span class="code-phptags">import</span> java.sql.*;<br>
<span class="code-phptags">import</span> java.util.ArrayList;<br><br>

<span class="code-phptags">import</span> javax.servlet.ServletException;<br>
<span class="code-phptags">import</span> javax.servlet.http.HttpServlet;<br>
<span class="code-phptags">import</span> javax.servlet.http.HttpServletRequest;<br>
<span class="code-phptags">import</span> javax.servlet.http.HttpServletResponse;<br><br>

<span class="code-phptags">import</span> com.google.gson.Gson<br>
<span class="code-phptags">import</span> com.model.*;<br><br>



<span class="code-phptags">public class</span> paginationdServlet <span class="code-phptags">extends</span> HttpServlet {<br><br>


<span class="code-comment">&nbsp;&nbsp;&nbsp;// database connection settings</span><br>
<span class="code-phptags">&nbsp;&nbsp;&nbsp;private</span> String dbURL = <span class="code-comment">"jdbc:mysql://localhost:3306/shope"</span>;<br>
<span class="code-phptags">&nbsp;&nbsp;&nbsp;private</span> String dbUser = <span class="code-comment">"root"</span>;</br>
<span class="code-phptags">&nbsp;&nbsp;&nbsp;private</span> String dbPass = <span class="code-comment">"secret"</span>;<br>
<span class="code-phptags">&nbsp;&nbsp;&nbsp;private</span> Connection connect = <span class="code-phptags">null</span>;<br>
<span class="code-phptags">&nbsp;&nbsp;&nbsp;private</span> ResultSet products = <span class="code-phptags">null</span>;<br><br>

    <span class="code-phptags">&nbsp;&nbsp;&nbsp;protected void</span> doGet(HttpServletRequest request,<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HttpServletResponse response) <span class="code-phptags">throws</span> ServletException, IOException {<br><br>
	
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// Specify how many results per page</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">int</span> rpp = 10;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// This will tell us the page number of our last page</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">int</span> last = 0;<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">try</span> {<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// connects to the database</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DriverManager.registerDriver(<span class="code-phptags">new</span> com.mysql.jdbc.Driver());<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;connect = DriverManager.getConnection(dbURL, dbUser, dbPass);<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// constructs SQL statement</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String sql = <span class="code-comment">"SELECT id FROM catalogsearch_fulltext"</span>;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Statement statement = connect.createStatement();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;products  = statement.executeQuery(sql);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;products.last();<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// This tells us the page number of our last page</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;last = (<span class="code-phptags">int</span>) Math.ceil((<span class="code-phptags">double</span>)products.getRow()/rpp);<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// This makes sure last cannot be less than 1</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">if</span>(last <= 0)<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;last = 1;<br><br>
			
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags">catch</span> (SQLException ex){<br><br>

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;e.printStackTrace();<br><br>
		            
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags">finally</span>{<br>
		    	  
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">if</span>(db != <span class="code-phptags">null</span>){<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// closes the database connection</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">try</span>{<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;db.close();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags">catch</span>(SQLException e){<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;e.printStackTrace();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
		            
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
			  
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;request.setAttribute(<span class="code-comment">"last"</span>,last);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;request.setAttribute(<span class="code-comment">"rpp"</span>,rpp);<br><br>
				
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;getServletContext()<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.getRequestDispatcher(<span class="code-comment">"/WEB-INF/content/index.jsp"</span>)<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.forward(request,response);<br><br>
			  
	&nbsp;&nbsp;&nbsp;}<br><br>
	
	<span class="code-phptags">&nbsp;&nbsp;&nbsp;protected void</span> doPost(HttpServletRequest request,<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HttpServletResponse response) <span class="code-phptags">throws</span> ServletException, IOException {<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// Getting variables from AJAX request</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">int</span> rpp = Integer.parseInt(request.getParameter(<span class="code-comment">"rpp"</span>));<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">int</span> last = Integer.parseInt(request.getParameter(<span class="code-comment">"last"</span>));<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">int</span> pn = Integer.parseInt(request.getParameter(<span class="code-comment">"pn"</span>));<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ArrayList&lt;Product&gt; productsArray = <span class="code-phptags">new</span> ArrayList&lt;Product&gt;();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Product product;<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// This makes sure the page number isn't below 1, or more than our last page</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">if</span> (pn &lt; <span class="code-phptags">1</span>) {<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pn = <span class="code-phptags">1</span>;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags"> else if </span>(pn &gt; last) { <br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pn = last;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// This sets the range of rows to query for the chosen pn</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String limit = <span class="code-comment">"LIMIT "</span> + (pn - 1) * rpp +<span class="code-comment">" ,"</span> + rpp;<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// This is your query again, it is for grabbing just one page worth of rows by applying limit</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String sql = <span class="code-comment">"SELECT * FROM catalogsearch_fulltext ORDER BY id DESC "</span> + limit;<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">try</span> {<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DriverManager.registerDriver(<span class="code-phptags">new</span> com.mysql.jdbc.Driver());<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;connect = DriverManager.getConnection(dbURL, dbUser, dbPass);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Statement statement = connect.createStatement();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;products  = statement.executeQuery(sql);<br><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">while</span>(products.next()) {<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;product = <span class="code-phptags">new</span> Product();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;product.setId(products.getString(1));<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;product.setProduct(products.getString(2));<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;productsArray.add(product);<br>			
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags">catch</span> (SQLException ex){<br><br>

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;e.printStackTrace();<br><br>
		            
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags">finally</span>{<br>
		    	  
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">if</span>(db != <span class="code-phptags">null</span>){<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// closes the database connection</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">try</span>{<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;db.close();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags">catch</span>(SQLException e){<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;e.printStackTrace();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
		            
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// Converting ArrayList obj to JSON obj</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String json = <span class="code-phptags">new</span> Gson().toJson(productsArray);<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// seting JSON obj in the responce</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PrintWriter out = response.getWriter();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;out.print(json);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;out.flush();<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;out.close();<br>
	
	&nbsp;&nbsp;&nbsp;}<br><br>

	}<br>
</code>

