const makeUserType = (obj) => ({...obj, to: `/transporter/dashboard${obj.to}`})
export default (language) => [
    { label: language.dashboard, to: "" },
    { label: language.messages, to: "/messages" },
    { divider: true },
    {
      groupLabel: language.bids,
      items: [
        { label: language.bidsExceeded, to: "/oubids" },
        { label: language.openBids, to: "/openbids" },
        { label: language.expired, to: "/expiredbids" },
        { label: language.invitations, to: "/invitations" },
        { label: language.completed, to: "/completedjobs" },
      ],
    },
    { divider: true },
    { label: language.settings, to: "/myprofile" },
]
.map((l) => l.label ? makeUserType(l) : l)
.map((lg) => lg.groupLabel ? ({...lg, items: lg.items.map((ii) => makeUserType(ii))}) : lg)

