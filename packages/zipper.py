import zipfile
import os

def zip_component(source_dir, output_filename):
    with zipfile.ZipFile(output_filename, 'w', zipfile.ZIP_DEFLATED) as zipf:
        for root, dirs, files in os.walk(source_dir):
            for file in files:
                file_path = os.path.join(root, file)
                # Calculate the relative path from the source_dir to keep structure flat
                arcname = os.path.relpath(file_path, source_dir)
                zipf.write(file_path, arcname)
                print(f"Adding {arcname}")

source_dir = 'com_servicos'
output_filename = 'com_servicos.zip'

if os.path.exists(output_filename):
    os.remove(output_filename)

zip_component(source_dir, output_filename)
print("Zip created successfully.")
