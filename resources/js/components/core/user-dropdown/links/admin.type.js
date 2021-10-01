const makeUserType = (obj) => ({...obj, to: `/dash${obj.to}`})
export default (language) => [
    { label: language.dashboard, to: "" },
]
.map((l) => l.label ? makeUserType(l) : l)
.map((lg) => lg.groupLabel ? ({...lg, items: lg.items.map((ii) => makeUserType(ii))}) : lg)

