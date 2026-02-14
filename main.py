from flask import Flask, request, jsonify
import joblib

app = Flask(__name__)
model = joblib.load("model.pkl")

@app.route("/predict", methods=["POST"])
def predict():
    speed = float(request.json["speed"])
    car_id = model.predict([[speed]])[0]
    return jsonify({"car_id": car_id})

app.run(port=5000)
