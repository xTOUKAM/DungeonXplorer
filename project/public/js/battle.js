class Combat {
    constructor(hero, monster) {
        this.hero = hero;
        this.monster = monster;
        this.log = [];
    }

    attack(attacker, defender) {
        const damage = Math.max(attacker.strength - defender.armor, 0);
        defender.pv -= damage;
        this.log.push(`${attacker.name} inflige ${damage} points de dégâts à ${defender.name}.`);
        return defender.pv <= 0 ? `${defender.name} est vaincu !` : null;
    }

    start() {
        this.log.push(`Le combat commence entre ${this.hero.name} et ${this.monster.name}.`);
        // Déroulement du combat...
    }
}

export default Combat;
