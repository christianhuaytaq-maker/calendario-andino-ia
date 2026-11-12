from fastapi import FastAPI
from pydantic import BaseModel
import uvicorn
from astral import moon
from datetime import date

app = FastAPI(title="Calendario Andino IA - Motor de Predicción")

class DatosClima(BaseModel):
    temperatura: float
    lluvia: float
    humedad: float
    area_hectareas: float = 1.0  # Recibimos el área (por defecto 1 hectárea)

def calcular_fase_lunar():
    # Astral nos da la fase lunar en un rango de 0 a 27.99
    fase_num = moon.phase(date.today())

    if fase_num < 1 or fase_num >= 27:
        return "Luna Nueva", "Buen momento para preparar el terreno y abonar."
    elif 1 <= fase_num < 6.5:
        return "Cuarto Creciente", "Óptimo para sembrar cultivos de fruto (papa, maíz) y trasplantar."
    elif 6.5 <= fase_num < 20.5:
        return "Luna Llena", "Excelente para cosechar, momento de máxima savia en la planta."
    else:
        return "Cuarto Menguante", "Ideal para sembrar cultivos de raíz (zanahoria), podar y controlar plagas."

@app.post("/predecir")
def predecir_siembra(datos: DatosClima):
    confianza = 0
    mensaje = ""

    # 1. Calculamos la luna real
    fase_lunar, consejo_lunar = calcular_fase_lunar()

    # 2. Evaluamos el clima real de la NASA
    if 8 <= datos.temperatura <= 18 and datos.lluvia > 10:
        confianza = 92
        mensaje = f"¡Es buen momento para sembrar! El clima es óptimo. Además, hoy hay {fase_lunar}."
    elif datos.temperatura < 8:
        confianza = 40
        mensaje = f"Riesgo de heladas. Se recomienda esperar. Hoy hay {fase_lunar}."
    elif datos.lluvia > 50:
        confianza = 50
        mensaje = f"Exceso de lluvia. Riesgo de pudrición. Hoy hay {fase_lunar}."
    else:
        confianza = 60
        mensaje = f"Condiciones regulares. Se puede sembrar con precaución. Hoy hay {fase_lunar}."

    # 3. CÁLCULO DE SEMILLA SEGÚN EL ÁREA
    # Papa: ~1,000 kg/ha | Maíz: ~25 kg/ha
    semilla_papa = round(1000 * datos.area_hectareas, 2)
    semilla_maiz = round(25 * datos.area_hectareas, 2)

    return {
        "recomendacion": mensaje,
        "nivel_confianza": confianza,
        "fase_lunar": fase_lunar,
        "consejo_lunar": consejo_lunar,
        "area_hectareas": datos.area_hectareas,
        "semilla_necesaria": {
            "papa_kg": semilla_papa,
            "maiz_kg": semilla_maiz
        },
        "cultivo_sugerido": "Papa",
        "fecha_sugerida": "15 al 25 de Noviembre de 2026"
    }

if __name__ == "__main__":
    uvicorn.run(app, host="127.0.0.1", port=8001)
