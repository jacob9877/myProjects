import requests
import json

class City:
    def __init__(self, name, lat, lon, units):
        self.name = name
        self.lat = lat
        self.lon = lon
        self.units = units
        self.get_data()

    def get_data(self):
        try:
            response = requests.get(f"https://api.openweathermap.org/data/2.5/weather?units={self.units}&lat={self.lat}&lon={self.lon}&appid=ba3c0e471d6b6ac1d90d5d42948971d5")
            response.raise_for_status() 
        except Exception as e:
            print(e)
       
        self.response_json = response.json()
        self.json_formatted_str = json.dumps(self.response_json, indent=2)
        self.temp = self.response_json["main"]["temp"]
        self.temp_min = self.response_json["main"]["temp_min"]
        self.temp_max = self.response_json["main"]["temp_max"]

    def temp_print(self):
        symbol = "C"
        if(self.units == "imperial"):
            symbol = "F"
        print(f"In {self.name} it is currently {self.temp}° {symbol}")
        print(f"Today's High: {self.temp_max}° {symbol}")
        print(f"Today's Low: {self.temp_min}° {symbol}")


my_city = City("Orlando",28.382203,-81.356729,"metric")
my_city.temp_print()
# print(my_city.json_formatted_str)