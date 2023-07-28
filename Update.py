import os
import webbrowser

# Função para atualizar o diretório a partir do GitHub
def update_from_github():
    os.chdir("C:\\Mix-Pdv")
    os.system("git pull https://github.com/luisgustavorr/PDV-Web.git")
    # Ou se o repositório já existe localmente:
    # os.system("cd pasta_destino && git pull")

# Configurações

update_from_github()
