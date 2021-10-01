const makeUserType = (obj) => ({...obj, to: `/user/dashboard${obj.to}`})
export default (language) => [
    { label: language.dashboard, to: "" },
    { label: language.messages, to: "/messages" },
    { divider: true },
    {
      groupLabel: language.shipments,
      items: [
        { label: language.openShipment, to: "/openshipments" },
        { label: language.awardedShipment, to: "/awardedshipments" },
        { label: language.expiredShipment, to: "/expiredshipments" },
        { label: language.completeShipment, to: "/completedshipments" },
      ],
    },
    { divider: true },
    { label: language.settings, to: "/myprofile" },
]
.map((l) => l.label ? makeUserType(l) : l)
.map((lg) => lg.groupLabel ? ({...lg, items: lg.items.map((ii) => makeUserType(ii))}) : lg)

