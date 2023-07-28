import os
import webbrowser

# Função para atualizar o diretório a partir do GitHub
def update_from_github():
    os.chdir("C:\\")
    os.system("git clone https://github.com/luisgustavorr/PDV-Web.git MIX-Pdv")
    # Ou se o repositório já existe localmente:
    # os.system("cd pasta_destino && git pull")

# Configurações

update_from_github()
