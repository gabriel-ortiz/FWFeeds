#Description:
This program is a build to output processed API data for Fourwinds. 

##Project dependencies:
This project uses Guzzle to make API HTTP requests. Guzzle, while may be a little overkill for the process, contains valuable helper methods for processing API data.

##Getting started:
1. For each project, create a new folder at the root of the FWFeeds directory -
2. Inside each folder, be sure to inlcude an index.php file (this is not necessary, but helpful)
3. Include any helper functions needed for procssing the API data
4. 

##Output:
Each output feed should be JSON level deep. Fourwinds can only traverse one level of API data, therefore the output should only be formatted with a parent object and children objects.

by: Gabriel Ortiz for Claremont Colleges Library
email: gabriel_ortiz@cuc.claremont.edu