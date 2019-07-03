# SOAPoc
This project is a proof of concept for the communication between a php soap webservice and a java application.
It contains the PHP sources of the server and a client that takes the form of a java object with methods to launch requests to the server.
With this project, data that is sent is not encrypted, but every request is authenticated using a system of Hash.

The server is connected to a mysql database that tan only be queryed by the server (and not the clients)
This makes a protection against unwanted queries and not to expose the sql passwords.
