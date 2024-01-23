class MobilePhone:
    # Atributos
    manufacturer: str
    screen_size: float
    num_cores: int
    apps: list[str]
    status: bool

    def __init__(self, manufacturer: str, screen_size: float, num_cores: int):
        self.manufacturer = manufacturer
        self.screen_size = screen_size
        self.num_cores = num_cores
        self.apps = [] # Usar set() para evitar duplicados
        self.status = False

    def power_on(self):
        self.status= True

    def power_off(self):
        self.status = False

    def install_app(self, *args: str):
        for app in args:
            if app not in self.apps:
                self.apps.append(app)

    def uninstall_app(self, app: str):
        if app in self.apps:
            self.apps.remove(app)

