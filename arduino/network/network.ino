/*
 XV: Oceans module controller
 Facilliates read access to sensors
 and read/write access to actuators
 
 Logan Rooper
 Jan 6, 2013
 xv-oceans.com

 Derived from Tom Igoe's Simple Web Server:
 Circuit:
 * Ethernet shield attached to pins 10, 11, 12, 13
 * Analog inputs attached to pins A0 through A5 (optional)
 
 created 18 Dec 2009
 by David A. Mellis
 modified 9 Apr 2012
 by Tom Igoe
 
 */

#include <SPI.h>
#include <Ethernet.h>
#include <dht11.h>
#include <Servo.h>

Servo servo1; 
dht11 DHT11; //DHT11
//String GET_param;

// Enter a MAC address and IP address for your controller below.
// The IP address will be dependent on your local network:
byte mac[] = { 
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress ip(169,254,63,189);

// Initialize the Ethernet server library
// with the IP address and port you want to use 
// (port 80 is default for HTTP):
EthernetServer server(80);

void setup() {
    //set up the internal servo 'servo1'
    servo1.attach(3); //digital pin 4
    
    //set up the internal humidity/temp sensor "DHT11"
    DHT11.attach(2); 
    Serial.print("LIBRARY VERSION: ");
    Serial.println(DHT11LIB_VERSION);
    
    //some initialization
    //GET_param = "";
    // Open serial communications and wait for port to open:
    Serial.begin(9600);
   while (!Serial) {
    ; // wait for serial port to connect. Needed for Leonardo only
  }


  // start the Ethernet connection and the server:
  Ethernet.begin(mac, ip);
  server.begin();
  Serial.print("server is at ");
  Serial.println(Ethernet.localIP());
  //Serial.println("break point");
}


void loop() {
  //read DHT11 sensor
  int chk = DHT11.read();
  //uncomment this to make DHT11 verbose...
  //Serial.print("Read sensor: ");
  //check if sensor is ok
  //switch (chk)
  //{
  //  case 0: Serial.println("OK"); break;
  //  case -1: Serial.println("DHT11 Checksum error"); break;
  //  case -2: Serial.println("DHT11 Time out error"); break;
  //  default: Serial.println("DHT11 Unknown error"); break;
  //}
  
  // listen for incoming clients
  EthernetClient client = server.available();
  if (client) {
    Serial.println("new client");
    // an http request ends with a blank line
    boolean currentLineIsBlank = true;
    boolean incoming = false;
    String GET_param = "";
    while (client.connected()) {
      if (client.available()) {
        char c = client.read();
        Serial.write(c);
        // if you've gotten to the end of the line (received a newline
        // character) and the line is blank, the http request has ended,
        // so you can send a reply
        if (c == '\n' && currentLineIsBlank) {
          // send a standard http response header
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println("Connnection: close");
          client.println();
          //client.println("<!DOCTYPE HTML>");
          //client.println("<html>");
                    // add a meta refresh tag, so the browser pulls again every 5 seconds:
          //client.println("<meta http-equiv=\"refresh\" content=\"1\">");
          // output the value of each analog input pin 
          // we don't care about analog pins right now
          /*for (int analogChannel = 0; analogChannel < 6; analogChannel++) {
            int sensorReading = analogRead(analogChannel);
            client.print("analog input ");
            client.print(analogChannel);
            client.print(" is ");
            client.print(sensorReading);
            client.println("<br />");       
          }*/
          //print the sensor output for DHT11
          //client.print("Reading DHT11 [INTERAL TEMPERATURE AND HUMIDITY]");
          //client.println("<br />"); 
           //client.print("Temperature (F): ");
          client.print(DHT11.fahrenheit(), DEC);
          client.print(",");
          //client.println("<br />"); 
         // client.print("Humidity (%): ");
          client.print((float)DHT11.humidity, DEC);
          client.print(",");
         
         
          
          //print sensor output for photocell
          int photocell_reading = analogRead(0); //connected to analog pin 0
          //client.print("<br /><br />Reading Photocell [INTERAL Photocell]");
          //client.println("<br />"); 
         // client.print("Voltage: ");
          client.print(photocell_reading);
          client.print(",");
          
          //print sensor output for external digital thermometer
          float voltage1 = analogRead(1); //connected to analog pin 1
          float ext_thermo_reading = voltage1 * 5.0;
          ext_thermo_reading /= 1024.0;
          float temperatureC = (ext_thermo_reading - 0.5) * 100;
          float temperatureF = (temperatureC * 9.0 / 5.0) + 32.0 +95.63; //added the +95.63 because it's not calibrated right or something....http://bildr.org/2011/07/ds18b20-arduino/
          //client.print("<br /><br />Reading Thermometer [EXTERNAL thermometer]");
          //client.println("<br />"); 
          //client.print("Voltage: ");
          //client.print(voltage1);
          
          //client.println("<br />"); 
          //client.print("Tempertature(F): ");
          client.print(temperatureF);
          client.print(",");
          
          client.println("</html>");
          break;
        }
        if (c == '?') {
          //Serial.print("GET paramter recieved");
          incoming = true;
        }
         if (c == '%') {
          //Serial.print("GET paramter ended");
          incoming = false;
        }
        if (incoming) {
            GET_param += c;
        }
        if (c == '\n') {
          // you're starting a new line
          currentLineIsBlank = true;
        } 
        else if (c != '\r') {
          // you've gotten a character on the current line
          currentLineIsBlank = false;
        }
      }
    }
    // give the web browser time to receive the data
    delay(1);
    // close the connection:
    client.stop();
    Serial.println("client disconnected");
    Serial.println();
    
    //now, we have the parameters so we can actuate whatever they requested
    //1 actuator hardcoded limit right now
    if (GET_param != "") {
    Serial.println("client GET request assembled:");
    Serial.println(GET_param);
    Serial.println();
    //parse the data out from the GET request
    int first_term = GET_param.indexOf('='); //should be 8 for ?actuate=0,19
    int last_term = GET_param.indexOf('%'); //should be 13 for ?actuate=0,19 
    String request = GET_param.substring(first_term+1,last_term);
    //parse the sensor number, sensor value
    int comma = request.indexOf(','); //should be 10 for ?actuate=0,.019
    int sensor_num = (request.substring(0,comma)).toInt();
    int sensor_value = (request.substring(comma+1)).toInt();
    
    //fire the actuators
    if (sensor_num == 0)
    {
      Serial.println("firing sensor");
      servo1.write(sensor_value);
      delay(15);
      
    }
    }
  }
}
