# WebBakery
The goal of the project was to create 4 module web application inspired by POS terminals that provides CRUD for each module, and also allows modules to echange data between each other.
For example: Module warehouse provides interface for user to add raw materials. Second module, eg. production, consumes the amount of raw ingredients in the warehouse and creates data that represent baked cakes that are ready to sell and which will be used by the module Sales.
Also it provides admin panel which shows how many cakes were sold for certain period of time or money earned, over the Chart.js library.

start_route: http://localhost/poslasticarnica/login/login.html
login_credentials:
warehouse:
          username: magacin
          password: 1111
production:
          username: proizvodnja
          password: 2222
sales    :
         usernames: radnja1
         password:  3333
admin    :
         username: admin
         password: 9999
