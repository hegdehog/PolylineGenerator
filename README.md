<p align="center">
<a href=""><img src="https://img.shields.io/badge/php-%23DD0031.svg?style=for-the-badge&logo=php&logoColor=white" /></a>
<a href=""><img src="https://img.shields.io/github/v/release/hegdehog/PolylineGenerator?style=for-the-badge" /></a>
<a href=""><img src="https://img.shields.io/github/repo-size/hegdehog/PolylineGenerator?style=for-the-badge" /></a>
</p>

# PolylineGenerator
This script generates a polyline code using a shapefile as source. The shapefile format is a geospatial vector data format for geographic information system (GIS) software, in our case, we use it to get the polygon's coordinates of a region or country. For example, we can use the polylines with *QlikMaps* (tool for *Qlik Sense*), which it's a reporting software for Data Vistualization.

It uses the code of Polyline Encoder from https://github.com/dyaaj (thanks!). 

## Using PolylineGenerator
There are two methods to use this script. The main use is the function **buildFriendlyHTMLViewer** which generates a SQL script to insert the polyline codes in a table. The other method **buildDmlScript** allow us to show a friendly view of the codes for check purpose (we can use this tool from Google: https://developers.google.com/maps/documentation/utilities/polylineutility?hl=es-419)

## Example
The following collection of coordinates represent the polygon of a little town (Alcorcón, Madrid, Spain):

        -3.80271911621095,40.3633918762208,0 -3.80690407752991,40.3666038513184,0 -3.81053400039672,40.3639030456543,0 -3.81314897537232,40.3697967529298,0 -3.83468604087824,40.3961296081543,0 -3.83030104637146,40.4016304016113,0 -3.83774304389953,40.4031066894531,0 -3.8458130359649,40.3907318115234,0 -3.86770701408381,40.3780097961426,0 -3.8665120601654,40.3739585876466,0 -3.87787795066835,40.3730964660645,0 -3.87884902954102,40.3697280883789,0 -3.87064909934998,40.358684539795,0 -3.87086296081542,40.3532257080079,0 -3.86765193939208,40.3535194396974,0 -3.86675405502319,40.3468856811524,0 -3.85911393165589,40.3434371948243,0 -3.85418391227712,40.3305435180665,0 -3.84749698638917,40.3258628845216,0 -3.84681797027589,40.3241500854492,0 -3.8385949134826,40.3245315551758,0 -3.817715883255,40.3276824951173,0 -3.81699991226197,40.3307342529298,0 -3.79979109764098,40.3427543640137,0 -3.8047161102295,40.3530426025392,0 -3.79892897605896,40.3566513061524,0 -3.78781390190125,40.3587532043457,0 -3.80271911621095,40.3633918762208,0
        
 Once we've passed it through the script, we get a polyline code:
        ``enjuF~ueVaSbYzOtUyc@hOqcDreCka@kZgHnm@hlAlq@nnAxgChXmFjD`fA`T`E~cAgr@ba@h@y@aSlh@sDpTwn@poAy]f\yh@tIgCkAkr@uRoaCaRoCcjAqjBi_Ax]qUec@cLodA_\d|A``
        
 This kind of format is accepted for many reporting tools, as we mentioned before, in our case we've used QlikMaps which read the polylines from a SQL table.
 
 ![polyline polygon](https://i0.wp.com/www.n4gash.com/wp-content/2017/11/alcorcon-shapefile.png?w=1290)
 
 More info and comments on: https://www.n4gash.com/2017/shapefiles-municipios-espana/
 
 
## Run Locally

Clone the project

```bash
  git clone git@github.com:hegdehog/PolylineGenerator.git
```
