import tkinter as tk
from tkinter import filedialog, messagebox
import shutil
import os

# Halaman utama
def halaman_utama():
    for widget in root.winfo_children():
        widget.destroy()
    
    label = tk.Label(root, text="📂 Daftar Arsip Surat", font=("Arial", 16))
    label.pack(pady=20)

    btn_lihat = tk.Button(root, text="Lihat Arsip", command=halaman_detail, width=20, bg="#4CAF50", fg="white")
    btn_lihat.pack(pady=10)

# Halaman detail arsip surat
def halaman_detail():
    for widget in root.winfo_children():
        widget.destroy()
    
    # Judul arsip
    tk.Label(root, text="Arsip Surat >> Lihat", font=("Arial", 16, "bold")).pack(pady=10)

    # Info surat
    tk.Label(root, text="Surat Undangan Rapat\nUniversitas Polinema\nTanggal: 14 September 2025\nNomor: 001/UND/2025").pack(pady=5)

    # Isi surat (contoh dummy)
    frame = tk.Frame(root, relief="sunken", borderwidth=1, width=400, height=200)
    frame.pack(pady=10)
    frame.pack_propagate(False)
    isi = tk.Label(frame, text="Isi Surat:\n\nDengan hormat, dimohon kehadirannya dalam rapat dosen...", justify="left")
    isi.pack(padx=10, pady=10, anchor="w")

    # Tombol navigasi
    frame_btn = tk.Frame(root)
    frame_btn.pack(pady=20)

    btn_back = tk.Button(frame_btn, text="<< Kembali", command=halaman_utama, width=15, bg="#f44336", fg="white")
    btn_back.grid(row=0, column=0, padx=10)

    btn_download = tk.Button(frame_btn, text="Unduh", command=unduh_pdf, width=15, bg="#2196F3", fg="white")
    btn_download.grid(row=0, column=1, padx=10)

# Fungsi unduh PDF
def unduh_pdf():
    # File sumber (contoh PDF dummy)
    source_file = "contoh.pdf"

    if not os.path.exists(source_file):
        with open(source_file, "w") as f:
            f.write("Ini contoh isi file PDF surat undangan rapat...")

    # Dialog pilih direktori
    save_path = filedialog.asksaveasfilename(defaultextension=".pdf", filetypes=[("PDF Files", "*.pdf")])

    if save_path:
        shutil.copy(source_file, save_path)
        messagebox.showinfo("Berhasil", f"File berhasil disimpan di:\n{save_path}")

# Root window
root = tk.Tk()
root.title("Aplikasi Arsip Surat")
root.geometry("600x400")

halaman_utama()

root.mainloop()
