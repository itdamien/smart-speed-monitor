#include <WiFi.h>
#include <HTTPClient.h>

const char* ssid = "YOUR_WIFI";
const char* password = "YOUR_PASSWORD";
const char* serverName = "http://localhost/iot/index.php";

#define TRIG1 5
#define ECHO1 18
#define TRIG2 17
#define ECHO2 16

#define RED 25
#define YELLOW 26
#define GREEN 27
#define BUZZER 14

float distanceBetweenSensors = 2.0; // meters

void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password);

  pinMode(TRIG1, OUTPUT);
  pinMode(ECHO1, INPUT);
  pinMode(TRIG2, OUTPUT);
  pinMode(ECHO2, INPUT);

  pinMode(RED, OUTPUT);
  pinMode(YELLOW, OUTPUT);
  pinMode(GREEN, OUTPUT);
  pinMode(BUZZER, OUTPUT);

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
  }
}

long measureDistance(int trig, int echo) {
  digitalWrite(trig, LOW);
  delayMicroseconds(2);
  digitalWrite(trig, HIGH);
  delayMicroseconds(10);
  digitalWrite(trig, LOW);
  long duration = pulseIn(echo, HIGH);
  return duration * 0.034 / 2;
}

void loop() {

  long d1 = measureDistance(TRIG1, ECHO1);
  while (measureDistance(TRIG2, ECHO2) > 20);

  unsigned long startTime = millis();
  while (measureDistance(TRIG2, ECHO2) < 20);
  unsigned long endTime = millis();

  float timeSeconds = (endTime - startTime) / 1000.0;
  float speed = (distanceBetweenSensors / timeSeconds) * 3.6;

  digitalWrite(RED, LOW);
  digitalWrite(YELLOW, LOW);
  digitalWrite(GREEN, LOW);
  digitalWrite(BUZZER, LOW);

  if (speed > 80) {
    digitalWrite(RED, HIGH);
    digitalWrite(BUZZER, HIGH);
  }
  else if (speed < 30) {
    digitalWrite(YELLOW, HIGH);
  }
  else {
    digitalWrite(GREEN, HIGH);
  }

  sendToServer(speed);
  delay(2000);
}

void sendToServer(float speed) {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(serverName);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    String data = "speed=" + String(speed);
    http.POST(data);
    http.end();
  }
}

