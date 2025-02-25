import numpy as np
import scipy.stats as stats
import matplotlib.pyplot as plt

def estudio_capacidad(datos, lsi, lss, nombre_proceso):
    """
    Realiza un estudio de capacidad para un conjunto de datos.

    Args:
        datos (array): Un array de NumPy con los datos del proceso.
        lsi (float): Límite de especificación inferior (LEI).
        lss (float): Límite de especificación superior (LES).
        nombre_proceso (str): Nombre del proceso para identificar los gráficos.

    Returns:
        None. Imprime resultados y muestra gráficos.
    """

    # Calcular estadísticas básicas
    media = np.mean(datos)
    desviacion_estandar = np.std(datos)

    # Calcular índices de capacidad
    cp = (lss - lsi) / (6 * desviacion_estandar)
    cpl = (media - lsi) / (3 * desviacion_estandar)
    cpu = (lss - media) / (3 * desviacion_estandar)
    cpk = min(cpl, cpu)

    # Calcular PPM (partes por millón) fuera de especificaciones
    ppm_inferior = stats.norm.cdf(lsi, media, desviacion_estandar) * 1000000
    ppm_superior = (1 - stats.norm.cdf(lss, media, desviacion_estandar)) * 1000000
    ppm_total = ppm_inferior + ppm_superior

    # Imprimir resultados
    print(f"Estudio de Capacidad para: {nombre_proceso}")
    print(f"Media: {media:.2f}")
    print(f"Desviación Estándar: {desviacion_estandar:.2f}")
    print(f"Cp: {cp:.2f}")
    print(f"Cpk: {cpk:.2f}")
    print(f"PPM Fuera de Especificaciones: {ppm_total:.2f}")

    # Generar histograma
    plt.figure(figsize=(10, 6))
    plt.hist(datos, bins=20, density=True, alpha=0.6, color='skyblue', label='Datos')

    # Ajustar distribución normal
    x = np.linspace(media - 3 * desviacion_estandar, media + 3 * desviacion_estandar, 100)
    plt.plot(x, stats.norm.pdf(x, media, desviacion_estandar), 'r-', label='Distribución Normal')

    # Límites de especificación
    plt.axvline(lsi, color='r', linestyle='--', label='LEI')
    plt.axvline(lss, color='r', linestyle='--', label='LES')

    plt.title(f"Histograma y Distribución Normal para: {nombre_proceso}")
    plt.xlabel("Valor de la Característica")
    plt.ylabel("Frecuencia")
    plt.legend()
    plt.show()

# Ejemplo de uso
datos_proveedor1 = np.random.normal(100, 5, 1000)  # Datos simulados del proveedor 1
datos_proveedor2 = np.random.normal(102, 8, 1000)  # Datos simulados del proveedor 2
lsi = 80  # Límite de especificación inferior
lss = 120  # Límite de especificación superior

estudio_capacidad(datos_proveedor1, lsi, lss, "Proveedor 1")
estudio_capacidad(datos_proveedor2, lsi, lss, "Proveedor 2")